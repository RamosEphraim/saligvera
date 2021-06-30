package com.rysaligvera.androidapp;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.rysaligvera.androidapp.R;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.content.Context.MODE_PRIVATE;

public class ProjectsFragment extends Fragment {

    List<Project> mDataset;
    private RecyclerView mRecyclerView;
    private RecyclerView.Adapter mAdapter;
    private RecyclerView.LayoutManager mLayoutManager;

    SwipeRefreshLayout mSwipeRefreshLayout;

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {

        mDataset = new ArrayList<>();
        mRecyclerView = view.findViewById(R.id.my_recycler_view);
        mRecyclerView.setHasFixedSize(true);


        mLayoutManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
        mRecyclerView.setLayoutManager(mLayoutManager);

        mSwipeRefreshLayout = view.findViewById(R.id.swipeRefreshLayout_blogposts);
        mSwipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                refreshItems();
            }
        });

        refreshItems();


        super.onViewCreated(view, savedInstanceState);
    }

    void refreshItems() {
        final ProgressDialog progressDialog = new ProgressDialog(getContext());
        progressDialog.setTitle("Loading...");
        progressDialog.setMessage("Please wait...");
        progressDialog.show();

        SharedPreferences prefs = getContext().getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE);
        int account_id = prefs.getInt("account_id", 0);
            ApiInterface service = ApiClient.getClient().create(ApiInterface.class);
            Call<List<Project>> call = service.fetchAllProjects("getAllProjectsByEAId", account_id);
            call.enqueue(new Callback<List<Project>>() {
                @Override
                public void onResponse(Call<List<Project>> call, Response<List<Project>> response) {
                    if(response.isSuccessful()){
                        mDataset = response.body();
                        mAdapter = new ProjectCustomAdapter(mDataset, getContext());
                        mRecyclerView.setAdapter(mAdapter);
                    }else{
                        Toast.makeText(getContext(), "Something went wrong...Please try later!", Toast.LENGTH_SHORT).show();
                    }
                    progressDialog.dismiss();
                }
                @Override
                public void onFailure(Call<List<Project>> call, Throwable t) {
                    progressDialog.dismiss();
                    Toast.makeText(getContext(), "Something went wrong...Please try later!" + t.toString(), Toast.LENGTH_SHORT).show();
                }
            });

        progressDialog.dismiss();
        onItemsLoadComplete();
    }

    void onItemsLoadComplete() {
        mSwipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_blog_posts, container, false);
    }
}

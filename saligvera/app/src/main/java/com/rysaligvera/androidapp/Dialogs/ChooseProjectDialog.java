package com.rysaligvera.androidapp.Dialogs;

import android.app.Dialog;
import android.app.Fragment;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatDialogFragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Toast;

import com.rysaligvera.androidapp.Adapters.revProjectAdapter;
import com.rysaligvera.androidapp.ApiClient;
import com.rysaligvera.androidapp.ApiInterface;
import com.rysaligvera.androidapp.AppConstants;
import com.rysaligvera.androidapp.Project;
import com.rysaligvera.androidapp.R;
import com.rysaligvera.androidapp.SharedR.SharedResources;
import com.rysaligvera.androidapp.SharedR.cpDialog;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.content.Context.MODE_PRIVATE;

public class ChooseProjectDialog extends AppCompatDialogFragment{

    private static final String TAG = "ChooseProjectDialog";

    private RecyclerView rcV;
    private RecyclerView.Adapter adapter;
    private RecyclerView.LayoutManager layoutManager;
    private ArrayAdapter mAdapter;
    private List<Project> projectDataSet;
    private ArrayList<String> projNames;
    private ArrayList<String> projDates;
    private ArrayList<String> projIDs;
    public cpDialog dialogResults;
    public Dialog onCreateDialog(Bundle savedInstanceState) {

        projectDataSet = new ArrayList<>();
        projNames = new ArrayList<>();
        projDates = new ArrayList<>();
        projIDs = new ArrayList<>();

        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());

        LayoutInflater inflater = getActivity().getLayoutInflater();
        View view = inflater.inflate(R.layout.layout_projectdialog,null);

        rcV = (RecyclerView) view.findViewById(R.id.rvProjList);

        loadProjects();

        builder.setView(view)
                .setTitle("Choose a Project")
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        String x = SharedResources.cProj.equals("") ? "No Project Selected" : SharedResources.cProj;
                        SharedResources.cProj = x;
                        dialogInterface.dismiss();
                    }
                })
                .setPositiveButton("Choose", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        Log.d(TAG, "onClick: " + SharedResources.cProj);
                        try {
                            dialogResults.applyChoice(SharedResources.cProj.split(" eden ")[0], SharedResources.cProj.split(" eden ")[1]);
                        } catch (NullPointerException e) {
                            Log.d(TAG, "onClick: " + e.getLocalizedMessage());
                        }
                    }
                });


        return builder.create();
    }

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        Log.d(TAG, "onAttach: test Attachments ");
        try {
            dialogResults =  (cpDialog) context;
        }catch (ClassCastException e) {
            Log.d(TAG, "onAttach: " + e.getLocalizedMessage());
        }
    }

    private void loadProjects() {
        SharedPreferences prefs = getContext().getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE);
        int account_id = prefs.getInt("account_id", 0);


        ApiInterface service = ApiClient.getClient().create(ApiInterface.class);
        Call<List<Project>> call = service.fetchAllProjects("getAllProjectsByEAId", account_id);
        call.enqueue(new Callback<List<Project>>() {
            @Override
            public void onResponse(Call<List<Project>> call, Response<List<Project>> response) {

                if(response.isSuccessful()){

                    projectDataSet = response.body();

                    for(Project p : projectDataSet) {
                        projNames.add(p.getProject_name());
                        projDates.add(p.getStart_date() + " - " + p.getEnd_date());
                        projIDs.add(String.valueOf(p.getProject_id()));
                    }

                    adapter = new revProjectAdapter(projNames, projDates, projIDs);
                    rcV.setAdapter(adapter);
                    layoutManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
                    rcV.setLayoutManager(layoutManager);

                }else{
                    Toast.makeText(getContext(), "Something went wrong...Please try later!", Toast.LENGTH_SHORT).show();
                }
            }
            @Override
            public void onFailure(Call<List<Project>> call, Throwable t) {
                Toast.makeText(getContext(), "Something went wrong...Please try later!" + t.toString(), Toast.LENGTH_SHORT).show();

            }
        });
    }
}

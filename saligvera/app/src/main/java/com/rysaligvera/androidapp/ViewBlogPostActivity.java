package com.rysaligvera.androidapp;

import android.app.ProgressDialog;
import android.content.Context;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.rysaligvera.androidapp.Dialogs.UploadImage;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ViewBlogPostActivity extends AppCompatActivity {
    ImageView news_thumbnail;
    TextView tvnewstitle, tvnewsdescription;
    Project project;

    Context cx;

    static UploadImage u;
    List<GalleryImage> mDataset;
    private RecyclerView mRecyclerView;
    private RecyclerView.Adapter mAdapter;
    private RecyclerView.LayoutManager mLayoutManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        cx = getApplicationContext();
        setContentView(R.layout.activity_view_blog_post);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        project =(Project)getIntent().getSerializableExtra("CurrentProject");
        setTitle(project.getProject_name());

        news_thumbnail = findViewById(R.id.newsthumbnail);
        tvnewstitle = findViewById(R.id.news_title);
        tvnewsdescription = findViewById(R.id.news_description);

        Glide.with(news_thumbnail.getContext()).load(project.getProject_image()).into(news_thumbnail);
        tvnewstitle.setText(project.getProject_name());
        tvnewsdescription.setText("Started: " + project.getStart_date() + "\nProgress:" + project.getProject_progress() + "%");

        mDataset = new ArrayList<>();
        mRecyclerView = findViewById(R.id.recycler_view_gallery);
        mRecyclerView.setHasFixedSize(true);

        mLayoutManager = new LinearLayoutManager(ViewBlogPostActivity.this, LinearLayoutManager.VERTICAL, false);
        mRecyclerView.setLayoutManager(mLayoutManager);

        loadAllProjectImage();

        FloatingActionButton fb = findViewById(R.id.btnCapture);

        fb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                u = new UploadImage();
                u.setContext(cx);
                u.setProjectID(String.valueOf(project.getProject_id()));
                u.show(getSupportFragmentManager(), "Dialog");
            }
        });

    }

    public static void closeDialog() {
        u.dismiss();
    }

    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }

    public void loadAllProjectImage(){

        final ProgressDialog progressDialog = new ProgressDialog(ViewBlogPostActivity.this);
        progressDialog.setTitle("Loading Images...");
        progressDialog.setMessage("Please wait...");
        progressDialog.show();

        ApiInterface service = ApiClient.getClient().create(ApiInterface.class);
        Call<List<GalleryImage>> call = service.fetchAllProjectImages("getAllProjectImages", project.getProject_id());
        call.enqueue(new Callback<List<GalleryImage>>() {
            @Override
            public void onResponse(Call<List<GalleryImage>> call, Response<List<GalleryImage>> response) {
                if(response.isSuccessful()){
                    mDataset = response.body();
                    mAdapter = new ProjectImagesCustomAdapter(mDataset, ViewBlogPostActivity.this);
                    mRecyclerView.setAdapter(mAdapter);
                }else{
                    Toast.makeText(ViewBlogPostActivity.this, "Couln't load images...Please try later!", Toast.LENGTH_SHORT).show();
                }
                progressDialog.dismiss();
            }
            @Override
            public void onFailure(Call<List<GalleryImage>> call, Throwable t) {
                progressDialog.dismiss();
                Toast.makeText(ViewBlogPostActivity.this, "Something went wrong...Please try later!" + t.toString(), Toast.LENGTH_SHORT).show();
            }
        });
        progressDialog.dismiss();
    }
}

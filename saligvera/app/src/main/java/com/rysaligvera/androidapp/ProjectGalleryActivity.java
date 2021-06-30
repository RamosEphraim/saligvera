package com.rysaligvera.androidapp;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import com.rysaligvera.androidapp.R;
public class ProjectGalleryActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_project_gallery);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        final Project news  =(Project)getIntent().getSerializableExtra("CurrentProject");
        setTitle(news.getProject_name());
    }
}

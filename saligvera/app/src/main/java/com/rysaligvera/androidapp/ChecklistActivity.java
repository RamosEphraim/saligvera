package com.rysaligvera.androidapp;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;
import android.widget.Toast;

import com.rysaligvera.androidapp.R;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ChecklistActivity extends AppCompatActivity {


    private List<ChecklistItem> checklistItems;
    private ListView lv;

    private ChecklistCustomAdapter checklistCustomAdapter;
    Project project;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_checklist);

        lv = findViewById(R.id.lvchecklist);

        project = (Project) getIntent().getSerializableExtra("CurrentProject");
        setTitle(project.getProject_name());

        loadChecklistItems();
    }

    public void loadChecklistItems() {
        final View promptsView = getLayoutInflater().inflate(R.layout.custom_addautoreply, null);
        final ProgressDialog progressDialog = new ProgressDialog(this);
        progressDialog.setTitle("Loading Checklist...");
        progressDialog.setMessage("Please wait...");
        progressDialog.show();

        SharedPreferences prefs = getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE);
        int account_id = prefs.getInt("account_id", 0);
        ApiInterface service = ApiClient.getClient().create(ApiInterface.class);
        Call<List<ChecklistItem>> call = service.getAllChecklistItems("getAllChecklistItems", account_id, project.getProject_id());
        call.enqueue(new Callback<List<ChecklistItem>>() {
            @Override
            public void onResponse(Call<List<ChecklistItem>> call, Response<List<ChecklistItem>> response) {
                if (response.isSuccessful()) {
                    if (response.body().size() < 1) {
                        Toast.makeText(getApplicationContext(), "Project does not have any task!", Toast.LENGTH_LONG).show();
                    } else {
                        checklistItems = response.body();
                        checklistCustomAdapter = new ChecklistCustomAdapter(checklistItems, promptsView, ChecklistActivity.this);
                        lv.setAdapter(checklistCustomAdapter);
                    }
                } else {
                    Toast.makeText(getApplicationContext(), "Something went wrong...Please try later!", Toast.LENGTH_SHORT).show();
                }
                progressDialog.dismiss();
            }

            @Override
            public void onFailure(Call<List<ChecklistItem>> call, Throwable t) {
                progressDialog.dismiss();
                Toast.makeText(getApplicationContext(), "Something went wrong...Please try later!" + t.toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}

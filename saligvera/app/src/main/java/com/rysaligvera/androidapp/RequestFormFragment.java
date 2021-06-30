package com.rysaligvera.androidapp;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.content.Context.MODE_PRIVATE;

public class RequestFormFragment extends Fragment {

    private static final String TAG = "RequestFormFragment";

    List<Supply> suppliesDataSet;
    List<Project> projectDataSet;

    Supply []supplyDatasetHolder;
    Project []projectDatasetHolder;


    Spinner projSpinner;
    Spinner supplySpinner;

    SuppliesSpinnerAdapter suppliesSpinnerAdapter;
    ProjectSpinnerAdapter projectSpinnerAdapter;

    SupplyRequest supplyRequest;

    Button btnrequest;
    TextView etSupply;

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {

        supplyRequest = new SupplyRequest();
        suppliesDataSet = new ArrayList<>();
        projectDataSet = new ArrayList<>();
        loadSupplies();
        loadProjects();


        projSpinner = (Spinner) getActivity().findViewById(R.id.spinnerproject);
        projSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view,
                                       int position, long id) {
                Project project = projectSpinnerAdapter.getItem(position);
                supplyRequest.setProject(project);
            }
            @Override
            public void onNothingSelected(AdapterView<?> adapter) {  }
        });


        supplySpinner = (Spinner) getActivity().findViewById(R.id.spinnersupply);
        supplySpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view,
                                       int position, long id) {
                Supply supply = suppliesSpinnerAdapter.getItem(position);
                supplyRequest.setSupply(supply);
            }
            @Override
            public void onNothingSelected(AdapterView<?> adapter) {  }
        });

        etSupply = view.findViewById(R.id.etsupply);

        btnrequest = view.findViewById(R.id.btnrequest);
        btnrequest.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SharedPreferences prefs = getContext().getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE);
                int account_id = prefs.getInt("account_id", 0);
                supplyRequest.setAccount_id(account_id);

                List<String> errors = new ArrayList<>();

                if(etSupply.getText().length() < 1) {
                    errors.add("Please input valid quantity!");
                }

                if(supplyRequest.getProject() == null) {
                    errors.add("No project is selected!");
                }

                if(supplyRequest.getSupply() == null) {
                    errors.add("No supply item selected!");
                }

                if(errors.size() == 0) {

                    supplyRequest.setQuantity(Integer.valueOf(etSupply.getText().toString()));
                    AlertDialog.Builder builder = new AlertDialog.Builder(getContext());
                    builder.setMessage(new StringBuilder().append("Are you sure you want to request ")
                            .append(supplyRequest.getQuantity())
                            .append(" ").append(supplyRequest.getSupply().getUnit().trim())
                            .append(" of ").append(supplyRequest.getSupply().getItem().trim())
                            .append(" for ").append(supplyRequest.getProject().getProject_name().trim())
                            .append(" ?").toString());
                    builder.setTitle("Send Request?");
                    builder.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            final ProgressDialog progressDialog = new ProgressDialog(getContext());
                            progressDialog.setTitle("Sending Request...");
                            progressDialog.setMessage("Please wait...");
                            progressDialog.setCancelable(false);
                            progressDialog.show();

                            ApiInterface service = ApiClient.getClient().create(ApiInterface.class);
                            Call<WebResponse> call = service.insertSupplyRequest("insertSupplyRequest",
                                    supplyRequest.getProject().getProject_id(),
                                    supplyRequest.getAccount_id(),
                                    supplyRequest.getSupply().getSupply_id(),
                                    supplyRequest.getQuantity());

                            call.enqueue(new Callback<WebResponse>() {
                                @Override
                                public void onResponse(Call<WebResponse> call, Response<WebResponse> response) {
                                    if(response.isSuccessful()){
                                        if(response.body().isSuccess())
                                        {
                                            Toast.makeText(getContext(), response.body().getMessage() , Toast.LENGTH_LONG).show();
                                        }
                                    }else{
                                        Toast.makeText(getContext(), "Something went wrong...Please try later!", Toast.LENGTH_SHORT).show();
                                    }
                                    progressDialog.dismiss();
                                }
                                @Override
                                public void onFailure(Call<WebResponse> call, Throwable t) {
                                    progressDialog.dismiss();
                                    Toast.makeText(getContext(), "Something went wrong...Please try later!", Toast.LENGTH_SHORT).show();
                                }
                            });
                        }
                    });

                    builder.setNegativeButton("No", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            dialogInterface.dismiss();
                        }
                    });

                    builder.show();
                } else {
                    Toast.makeText(getContext(), TextUtils.join("\n", errors), Toast.LENGTH_SHORT).show();
                }
            }
        });

        super.onViewCreated(view, savedInstanceState);
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

                    Log.d(TAG, "loadProjects: Projects Loading");
                    projectDataSet = response.body();
                    if(projectDataSet.size() > 0){
                        projectDatasetHolder = new Project[projectDataSet.size()];
                        for(int i = 0; i < projectDataSet.size(); i++)
                        {
                            projectDatasetHolder[i] = projectDataSet.get(i);
                        }
                        projectSpinnerAdapter = new ProjectSpinnerAdapter(getContext(),
                                android.R.layout.simple_spinner_item,
                                projectDatasetHolder);
                        projSpinner.setAdapter(projectSpinnerAdapter);
                    }
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

    private void loadSupplies() {
        ApiInterface service = ApiClient.getClient().create(ApiInterface.class);

        Log.d(TAG, "onResponse: Testing Load Supplies");


        Call<List<Supply>> call = service.fetchAllSupplies("getAllSupplies");
        call.enqueue(new Callback<List<Supply>>() {
            @Override
            public void onResponse(Call<List<Supply>> call, Response<List<Supply>> response) {
                Log.d(TAG, "onResponse: response Supplies " + response.isSuccessful());
                if(response.isSuccessful()){
                    suppliesDataSet = response.body();

                    if(suppliesDataSet.size() > 0){
                        supplyDatasetHolder = new Supply[suppliesDataSet.size()];

                        for(int i = 0; i < suppliesDataSet.size(); i++)
                        {
                            supplyDatasetHolder[i] = suppliesDataSet.get(i);
                        }
                        suppliesSpinnerAdapter = new SuppliesSpinnerAdapter(getContext(),
                                        android.R.layout.simple_spinner_item,
                                        supplyDatasetHolder);
                        supplySpinner.setAdapter(suppliesSpinnerAdapter);
                    }

                }else{
                    Toast.makeText(getContext(), "Couldn't load supplies...Please try later!", Toast.LENGTH_SHORT).show();
                }
            }
            @Override
            public void onFailure(Call<List<Supply>> call, Throwable t) {
                Toast.makeText(getContext(), "Something went wrong...Please try later!" + t.toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_request_form, container, false);
    }

}

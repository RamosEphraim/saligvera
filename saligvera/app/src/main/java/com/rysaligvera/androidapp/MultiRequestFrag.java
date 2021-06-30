package com.rysaligvera.androidapp;

import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.rysaligvera.androidapp.Adapters.supplyRequestsAdapter;
import com.rysaligvera.androidapp.Dialogs.ChooseProjectDialog;
import com.rysaligvera.androidapp.Dialogs.ChooseSupplyDialog;
import com.rysaligvera.androidapp.SharedR.SharedResources;
import com.rysaligvera.androidapp.SharedR.cpDialog;

import org.w3c.dom.Text;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;
import java.util.HashMap;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.content.Context.MODE_PRIVATE;

public class MultiRequestFrag extends Fragment implements cpDialog, DatePickerDialog.OnDateSetListener {

    //TODO: Batch Insert ! -> Send JSON String to PHP then do Batch Insert
    private static final String TAG = "MultiRequestFrag";
    public static Button btnChoose;
    public static TextView txtProjectDate;
    public static RecyclerView recyclerView;
    public static RecyclerView.Adapter adapter;
    private RecyclerView.LayoutManager layoutManager;
    private String JSONReq = "";

    ImageView setDateReserver;
    TextView txtDate;

    SupplyRequest supplyRequest;

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        SharedResources.SupplyRequest = new ArrayList<>();
        supplyRequest = new SupplyRequest();
        btnChoose = (Button) view.findViewById(R.id.btnChooseProject);
        txtProjectDate = (TextView) view.findViewById(R.id.txtProjectDate);

        recyclerView = (RecyclerView) view.findViewById(R.id.supplyrequests);

        adapter = new supplyRequestsAdapter();
        recyclerView.setAdapter(adapter);
        layoutManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
        recyclerView.setLayoutManager(layoutManager);

        btnChoose.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //Opens Dialog
                openDialog();
            }
        });

        Button btnSupply = view.findViewById(R.id.btnAddSupply);

        btnSupply.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                openDialogSupply();
            }
        });


        Button btnSR = view.findViewById(R.id.btnSendRequest);
        btnSR.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                SharedPreferences prefs = getContext().getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE);
                int account_id = prefs.getInt("account_id", 0);

                Log.d(TAG, "onClick: " + account_id);
                supplyRequest.setAccount_id(account_id);


                List<String> errors = new ArrayList<>();

                if(SharedResources.cProjID == null || SharedResources.cProjID.isEmpty()) {
                    errors.add("No project is selected!");
                }

                if(SharedResources.SupplyRequest.size() == 0) {
                    errors.add("No supply item selected!");
                }

                if(txtDate.getText().toString().isEmpty()) {

                    errors.add("No date was selected!");
                }

                if(errors.size() == 0) {

                    JSONReq = "{";

                    int i = 0;
                    while (i < SharedResources.SupplyRequest.size() - 1) {
                        JSONReq += " \"" + i + "\" : { \"supply_id\" : \"" + SharedResources.SupplyRequest.get(i).get("supply_id")  + "\", \"supply_quantity\" : \"" +  SharedResources.SupplyRequest.get(i).get("supply_quantity") + "\"} ,";
                        i++;
                    }
                    JSONReq += " \"" + i + "\" : { \"supply_id\" : \"" + SharedResources.SupplyRequest.get(SharedResources.SupplyRequest.size() - 1).get("supply_id")  + "\", \"supply_quantity\" : \"" +  SharedResources.SupplyRequest.get(SharedResources.SupplyRequest.size() - 1).get("supply_quantity") + "\"} }";

                    Log.d(TAG, "onClick: " + JSONReq);


                    AlertDialog.Builder builder = new AlertDialog.Builder(getContext());
                    builder.setMessage(new StringBuilder().append("Are you sure you want to request those items? "));
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
                            Call<WebResponse> call = service.insertSupplyRequestV2("insertSupplyRequestV2",
                                    Integer.parseInt(SharedResources.cProjID),
                                    supplyRequest.getAccount_id(),
                                    JSONReq,
                                    txtDate.getText().toString()
                                    );

                            call.enqueue(new Callback<WebResponse>() {
                                @Override
                                public void onResponse(Call<WebResponse> call, Response<WebResponse> response) {
                                    if(response.isSuccessful()){
                                        ProjectsFragment projectsFragment1 = new ProjectsFragment();
                                       FragmentManager manager = getActivity().getSupportFragmentManager();
                                        manager.beginTransaction().replace(R.id.fragment, projectsFragment1).commit();
                                        Toast.makeText(getContext(), response.body().getMessage() , Toast.LENGTH_LONG).show();
                                    }else{
                                        Toast.makeText(getContext(), "Something went wrong...Please try later!", Toast.LENGTH_LONG).show();
                                    }
                                    progressDialog.dismiss();
                                }
                                @Override
                                public void onFailure(Call<WebResponse> call, Throwable t) {
                                    progressDialog.dismiss();
                                    Toast.makeText(getContext(), "Something went wrong...Please try later!", Toast.LENGTH_LONG).show();
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

        Date date = new Date();
        Calendar cal = new GregorianCalendar();
        cal.setTime(date);
        date = cal.getTime();

        final DatePickerDialog datePickerDialog = new DatePickerDialog(
                getContext(), MultiRequestFrag.this, cal.getTime().getYear(), cal.getTime().getDay(), cal.getTime().getDate());

        setDateReserver = getActivity().findViewById(R.id.setDate);
        txtDate = getActivity().findViewById(R.id.txtDate);

        datePickerDialog.getDatePicker().setMinDate(date.getTime());
        setDateReserver.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                datePickerDialog.show();
            }
        });

        txtDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                datePickerDialog.show();
            }
        });

        super.onViewCreated(view, savedInstanceState);
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_multi_request, container, false);
    }

    public void openDialog() {
        ChooseProjectDialog cp = new ChooseProjectDialog();
        cp.show(getFragmentManager(), "Project");
    }

    public void openDialogSupply() {
        ChooseSupplyDialog cp = new ChooseSupplyDialog();
        cp.show(getFragmentManager(), "Supply");
    }

    @Override
    public void applyChoice(String ProjectName, String ProjectDate) {

    }

    @Override
    public void onDateSet(DatePicker datePicker, int i, int i1, int i2) {

        String month = i1 < 10 ? "0" + String.valueOf(i1 + 1) : String.valueOf(i1 + 1);
        String day = i2 < 10 ? "0" + String.valueOf(i2) : String.valueOf(i2);
        txtDate.setText(new StringBuilder().append(i).append("-").append(month).append("-").append(day));
    }
}

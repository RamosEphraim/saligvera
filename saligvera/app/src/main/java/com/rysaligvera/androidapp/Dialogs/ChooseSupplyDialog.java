package com.rysaligvera.androidapp.Dialogs;

import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatDialogFragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.rysaligvera.androidapp.Adapters.revProjectAdapter;
import com.rysaligvera.androidapp.Adapters.revSupplyAdapter;
import com.rysaligvera.androidapp.ApiClient;
import com.rysaligvera.androidapp.ApiInterface;
import com.rysaligvera.androidapp.MainActivity;
import com.rysaligvera.androidapp.MultiRequestFrag;
import com.rysaligvera.androidapp.R;
import com.rysaligvera.androidapp.SharedR.SharedResources;
import com.rysaligvera.androidapp.Supply;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.support.constraint.Constraints.TAG;

public class ChooseSupplyDialog extends AppCompatDialogFragment {

    private List<Supply> suppliesDataSet ;
    private ArrayList<String> lst_supplies;
    private ArrayList<String> lst_description;
    private ArrayList<String> lst_spID;
    private ArrayList<String> lst_units;

    private RecyclerView recyclerView;
    private RecyclerView.Adapter adapter;
    private RecyclerView.LayoutManager layoutManager;


    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {
        suppliesDataSet = new ArrayList<>();
        lst_supplies = new ArrayList<>();
        lst_description = new ArrayList<>();
        lst_spID = new ArrayList<>();
        lst_units = new ArrayList<>();

        final AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());

        LayoutInflater inflater = getActivity().getLayoutInflater();
        final View view = inflater.inflate(R.layout.layout_supplydialog, null);

        recyclerView = (RecyclerView) view.findViewById(R.id.rvProjList);

        loadSupplies();

        builder.setView(view)
                .setTitle("Choose an Item")
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        dialogInterface.dismiss();
                    }
                })
                .setPositiveButton("Choose", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        HashMap<String, String> hash = new HashMap<>();
                        hash.put("supply", SharedResources.supply_name);
                        hash.put("description", SharedResources.supply_desc);
                        hash.put("supply_id", SharedResources.supply_id);
                        hash.put("unit", SharedResources.supply_unit);
                        hash.put("supply_quantity", ((TextView) view.findViewById(R.id.txtSupply)).getText().toString());
                        SharedResources.SupplyRequest.add(hash);

                        MultiRequestFrag.adapter.notifyDataSetChanged();
                    }
                });


        return builder.create();
    }

    private void loadSupplies() {
        ApiInterface service = ApiClient.getClient().create(ApiInterface.class);


        Call<List<Supply>> call = service.fetchAllSupplies("getAllSupplies");
        call.enqueue(new Callback<List<Supply>>() {
            @Override
            public void onResponse(Call<List<Supply>> call, Response<List<Supply>> response) {
                if(response.isSuccessful()){
                    suppliesDataSet = response.body();

                    for(Supply s: suppliesDataSet) {
                        lst_supplies.add(s.getItem());
                        lst_description.add(s.getSupplier());
                        lst_units.add(s.getUnit());
                        lst_spID.add(String.valueOf(s.getSupply_id()));
                    }

                    adapter = new revSupplyAdapter(lst_supplies, lst_description, lst_spID, lst_units);
                    recyclerView.setAdapter(adapter);
                    layoutManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
                    recyclerView.setLayoutManager(layoutManager);

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
}

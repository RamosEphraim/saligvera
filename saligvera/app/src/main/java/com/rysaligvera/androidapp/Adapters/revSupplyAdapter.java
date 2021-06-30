package com.rysaligvera.androidapp.Adapters;

import android.content.res.ColorStateList;
import android.graphics.Color;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.rysaligvera.androidapp.R;
import com.rysaligvera.androidapp.SharedR.SharedResources;

import java.util.ArrayList;
import java.util.HashMap;

public class revSupplyAdapter extends RecyclerView.Adapter<revSupplyAdapter.ViewHolder>{

    private ArrayList<String> lst_supplies;
    private ArrayList<String> lst_description;
    private ArrayList<String> lst_spID;
    private ArrayList<String> lst_units;

    private revSupplyAdapter.ViewHolder temp_holder;

    public revSupplyAdapter(ArrayList<String> lst_supplies, ArrayList<String> lst_description, ArrayList<String> lst_spID, ArrayList<String> lst_units) {
        this.lst_supplies = lst_supplies;
        this.lst_description = lst_description;
        this.lst_spID = lst_spID;
        this.lst_units = lst_units;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.layout_recsup_adapter, parent, false);
        return new ViewHolder(view);

    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        String newS = lst_description.get(position) + " [ Unit : " + lst_units.get(position) + " ]";
        holder.SupplyDesc.setText(newS);
        holder.SupplyID.setText(lst_spID.get(position));
        holder.SupplyName.setText(lst_supplies.get(position));

        final ViewHolder h = holder;
        final int pos = position;

        holder.linearLayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                TextView txt = (TextView) view.findViewById(R.id.txtSupply);
                h.linearLayout.setBackgroundResource(R.color.colorPrimaryDark);
                txt.setTextColor(Color.WHITE);
                if (temp_holder != null) {
                    temp_holder.linearLayout.setBackgroundResource(R.color.colorWhite);
                    temp_holder.SupplyName.setTextColor(Color.BLACK);
                }
                temp_holder = h;

                SharedResources.supply_name = h.SupplyName.getText().toString();
                SharedResources.supply_desc = lst_description.get(pos);
                SharedResources.supply_id = h.SupplyID.getText().toString();
                SharedResources.supply_unit = lst_units.get(pos);

            }
        });

    }

    @Override
    public int getItemCount() {
        return lst_supplies.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{

        TextView SupplyName;
        TextView SupplyDesc;
        TextView SupplyID;
        LinearLayout linearLayout;

        public ViewHolder(View itemView) {
            super(itemView);

            SupplyName = (TextView) itemView.findViewById(R.id.txtSupply);
            SupplyDesc = (TextView) itemView.findViewById(R.id.txtDescription);
            SupplyID = (TextView) itemView.findViewById(R.id.txtSupplyID);
            linearLayout = (LinearLayout) itemView.findViewById(R.id.rootLayout);
        }
    }
}

package com.rysaligvera.androidapp.Adapters;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import com.rysaligvera.androidapp.R;
import com.rysaligvera.androidapp.SharedR.SharedResources;

import java.util.ArrayList;

public class supplyRequestsAdapter  extends  RecyclerView.Adapter<supplyRequestsAdapter.ViewHolder> {


    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.layout_suppyrequests_adapter, null);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, final int position) {
        if(!SharedResources.SupplyRequest.isEmpty()) {
            holder.RequestSupplyName.setText(SharedResources.SupplyRequest.get(position).get("supply"));
            String indicate_q = "[" + SharedResources.SupplyRequest.get(position).get("supply_quantity") + " " + SharedResources.SupplyRequest.get(position).get("unit") + "]";
            holder.RequestQuantity.setText(indicate_q);
            holder.RequestDescription.setText(SharedResources.SupplyRequest.get(position).get("description"));
        }

        holder.RemoveButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SharedResources.SupplyRequest.remove(position);
                notifyDataSetChanged();
            }
        });
    }

    @Override
    public int getItemCount() {
        return SharedResources.SupplyRequest.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        TextView RequestSupplyName;
        TextView RequestQuantity;
        TextView RequestDescription;
        Button RemoveButton;

        public ViewHolder(View itemView) {
            super(itemView);
            RequestSupplyName = (TextView) itemView.findViewById(R.id.txtSupplyRequest);
            RequestQuantity = (TextView) itemView.findViewById(R.id.txtSupplyRequestQuantity);
            RequestDescription = (TextView) itemView.findViewById(R.id.txtSupplyRequestDesc);
            RemoveButton = (Button) itemView.findViewById(R.id.btnRemove);
        }
    }
}

package com.rysaligvera.androidapp.Adapters;

import android.graphics.Color;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.rysaligvera.androidapp.R;
import com.rysaligvera.androidapp.SharedR.SharedResources;

import java.util.ArrayList;

public class revProjectAdapter extends RecyclerView.Adapter<revProjectAdapter.ViewHolder> {

    private static final String TAG = "revProjectAdapter";
    private ArrayList<String> lst_projectNames;
    private ArrayList<String> lst_projectDates;
    private ArrayList<String> lst_projectID;
    private ViewHolder temp_holder;

    public revProjectAdapter(ArrayList<String> lst_projectNames, ArrayList<String> lst_projectDates, ArrayList<String> lst_projectID ) {
        this.lst_projectNames = lst_projectNames;
        this.lst_projectDates = lst_projectDates;
        this.lst_projectID = lst_projectID;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.layout_cprod_adapter, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        holder.ProjectName.setText(lst_projectNames.get(position));
        holder.ProjectDate.setText(lst_projectDates.get(position));
        holder.ProjectID.setText(lst_projectID.get(position));

        final int pos = position;
        final ViewHolder h = holder;

        holder.ProjectName.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Log.d(TAG, "onClick: " + temp_holder);
                TextView txt = (TextView) view.findViewById(R.id.txtProjName);
                h.linearLayout.setBackgroundResource(R.color.colorPrimaryDark);
                txt.setTextColor(Color.WHITE);
                if (temp_holder != null) {
                    temp_holder.linearLayout.setBackgroundResource(R.color.colorWhite);
                    temp_holder.ProjectName.setTextColor(Color.BLACK);
                }
                temp_holder = h;
                SharedResources.cProj = h.ProjectName.getText().toString() + " eden " + h.ProjectDate.getText().toString();
                SharedResources.cProjID = h.ProjectID.getText().toString();
                Log.d(TAG, "onClick: " + SharedResources.cProj);
            }
        });

    }

    @Override
    public int getItemCount() {
        return lst_projectNames.size();
    }

    @Override
    public long getItemId(int position) {
        return super.getItemId(position);
    }

    @Override
    public int getItemViewType(int position) {
        return super.getItemViewType(position);
    }

    public class ViewHolder extends  RecyclerView.ViewHolder {

        TextView ProjectName;
        TextView ProjectDate;
        TextView ProjectID;
        LinearLayout linearLayout;

        public ViewHolder(View itemView) {
            super(itemView);
            ProjectName = itemView.findViewById(R.id.txtProjName);
            ProjectDate = itemView.findViewById(R.id.txtProjTime);
            linearLayout = itemView.findViewById(R.id.rootLayout);
            ProjectID = itemView.findViewById(R.id.txtProjID);
        }
    }
}

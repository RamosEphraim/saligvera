package com.rysaligvera.androidapp;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.rysaligvera.androidapp.R;

import org.w3c.dom.Text;

import java.util.List;

public class ProjectCustomAdapter extends RecyclerView.Adapter<ProjectCustomAdapter.ViewHolder> {
    private Context context;


    private List<Project> mDataset;
    AlertDialog.Builder builder;


    class ViewHolder extends RecyclerView.ViewHolder {

        ImageView icon;
        TextView projtitle;
        TextView architect;
        TextView startdate;
        TextView enddate;
        TextView budget;
        ProgressBar myProgress;
        TextView progresstext;
        Button btnviewchecklist;

        ViewHolder(View v) {
            super(v);
            icon = v.findViewById(R.id.icon);
            projtitle = v.findViewById(R.id.projtitle);
            architect = v.findViewById(R.id.architect);
            startdate = v.findViewById(R.id.startdate);
            enddate = v.findViewById(R.id.enddate);
            budget = v.findViewById(R.id.budget);
            myProgress = v.findViewById(R.id.myProgress);
            progresstext = v.findViewById(R.id.progresstext);
            btnviewchecklist = v.findViewById(R.id.btnviewchecklist);

        }
    }
    public void add(int position, Project item) {
        mDataset.add(position, item);
        notifyItemInserted(position);
    }
    public void remove(Project item) {
        int position = mDataset.indexOf(item);
        mDataset.remove(position);
        notifyItemRemoved(position);
    }

    ProjectCustomAdapter(List<Project> myDataset, Context context) {
        mDataset = myDataset;
        this.context = context;
    }
    @NonNull
    @Override
    public ProjectCustomAdapter.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent,
                                                              int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.recycler_card_project, parent, false);
        return new ViewHolder(v);
    }
    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, final int position) {

        final Project project = mDataset.get(position);
        holder.projtitle.setText(project.getProject_name());
        holder.architect.setText("Engr / Architects" + project.getProject_architect());
        holder.startdate.setText("Start Date: " + project.getStart_date());
        holder.enddate.setText("End Date: " + project.getEnd_date());
        holder.budget.setText("Budget: " + project.getBudget());
        holder.progresstext.setText(project.getProject_progress() + "%");
        holder.myProgress.setProgress(project.getProject_progress());

        Glide.with(holder.icon.getContext()).load(project.getProject_image()).into(holder.icon);

        holder.btnviewchecklist.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent view_intent = new Intent(context, ChecklistActivity.class);
                view_intent.putExtra("CurrentProject", project);
                context.startActivity(view_intent);

            }
        });
    }

    @Override
    public int getItemCount() {
        return mDataset.size();
    }

    private String stripHtml(String html) {
        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.N) {
            return String.valueOf(Html.fromHtml(html, Html.FROM_HTML_MODE_LEGACY));
        } else {
            return String.valueOf(Html.fromHtml(html));
        }
    }
}
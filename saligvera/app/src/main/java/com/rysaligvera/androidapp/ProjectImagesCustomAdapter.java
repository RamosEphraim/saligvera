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

import java.util.List;

public class ProjectImagesCustomAdapter extends RecyclerView.Adapter<ProjectImagesCustomAdapter.ViewHolder> {
    private Context context;


    private List<GalleryImage> mDataset;
    AlertDialog.Builder builder;


    class ViewHolder extends RecyclerView.ViewHolder {

        ImageView gallery_image;
        TextView date_uploaded;
        ViewHolder(View v) {
            super(v);
            gallery_image = v.findViewById(R.id.imggallery);
            date_uploaded = v.findViewById(R.id.datetaken);

        }
    }
    public void add(int position, GalleryImage item) {
        mDataset.add(position, item);
        notifyItemInserted(position);
    }
    public void remove(GalleryImage item) {
        int position = mDataset.indexOf(item);
        mDataset.remove(position);
        notifyItemRemoved(position);
    }

    ProjectImagesCustomAdapter(List<GalleryImage> myDataset, Context context) {
        mDataset = myDataset;
        this.context = context;
    }
    @NonNull
    @Override
    public ProjectImagesCustomAdapter.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent,
                                                                    int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.recycler_card_project_image, parent, false);
        return new ViewHolder(v);
    }
    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, final int position) {

        final GalleryImage galleryImage = mDataset.get(position);
        holder.date_uploaded.setText("Uploaded " + galleryImage.getDate_uploaded());
        Glide.with(holder.gallery_image.getContext()).load(galleryImage.getPhoto()).into(holder.gallery_image);

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
package com.rysaligvera.androidapp;

import com.google.gson.annotations.SerializedName;

public class GalleryImage{

    @SerializedName("photo_id")
    private int photo_id;

    @SerializedName("project_id")
    private int project_id;

    @SerializedName("photo")
    private String photo;

    @SerializedName("date_uploaded")
    private String date_uploaded;


    public int getPhoto_id() {
        return photo_id;
    }

    public void setPhoto_id(int photo_id) {
        this.photo_id = photo_id;
    }

    public int getProject_id() {
        return project_id;
    }

    public void setProject_id(int project_id) {
        this.project_id = project_id;
    }

    public String getPhoto() {
        return photo;
    }

    public void setPhoto(String photo) {
        this.photo = photo;
    }

    public String getDate_uploaded() {
        return date_uploaded;
    }

    public void setDate_uploaded(String date_uploaded) {
        this.date_uploaded = date_uploaded;
    }
}

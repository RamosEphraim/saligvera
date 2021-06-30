package com.rysaligvera.androidapp;

import com.google.gson.annotations.SerializedName;

import java.io.Serializable;

public class Project implements Serializable{
    @SerializedName("project_id")
    private int project_id;

    @SerializedName("budget")
    private double budget;

    @SerializedName("project_name")
    private String project_name;

    @SerializedName("start_date")
    private String start_date;

    @SerializedName("end_date")
    private String end_date;

    @SerializedName("project_progress")
    private int project_progress;

    @SerializedName("project_image")
    private String project_image;

    @SerializedName("engineers_architects")
    private String project_architect;

    public String getProject_architect() {
        return project_architect;
    }

    public void setProject_architect(String project_architect) {
        this.project_architect = project_architect;
    }

    public String getProject_image() {
        return project_image;
    }

    public void setProject_image(String project_image) {
        this.project_image = project_image;
    }

    public int getProject_id() {
        return project_id;
    }

    public void setProject_id(int project_id) {
        this.project_id = project_id;
    }

    public String getProject_name() {
        return project_name;
    }

    public void setProject_name(String project_name) {
        this.project_name = project_name;
    }

    public double getBudget() {
        return budget;
    }

    public void setBudget(double budget) {
        this.budget = budget;
    }

    public String getStart_date() {
        return start_date;
    }

    public void setStart_date(String start_date) {
        this.start_date = start_date;
    }

    public String getEnd_date() {
        return end_date;
    }

    public void setEnd_date(String end_date) {
        this.end_date = end_date;
    }

    public int getProject_progress() {
        return project_progress;
    }

    public void setProject_progress(int project_progress) {
        this.project_progress = project_progress;
    }
}

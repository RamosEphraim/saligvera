package com.rysaligvera.androidapp;

import com.google.gson.annotations.SerializedName;

public class ChecklistItem {
    @SerializedName("check_id")
    private int check_id;

    @SerializedName("project_id")
    private int project_id;

    @SerializedName("task")
    private String task;

    @SerializedName("percentage")
    private int percentage;

    @SerializedName("task_status")
    private int task_status;

    @SerializedName("start")
    private String start;

    @SerializedName("end")
    private String end;

    private boolean checked;

    public boolean isChecked() {
        return checked;
    }

    public void setChecked(boolean checked) {
        this.checked = checked;
    }

    private String []statuses = {"Finished", "Ongoing" , "Pending"};

    public  String getStatus() {
        return statuses[task_status];
    }
    public int getCheck_id() {
        return check_id;
    }

    public void setCheck_id(int check_id) {
        this.check_id = check_id;
    }

    public int getProject_id() {
        return project_id;
    }

    public void setProject_id(int project_id) {
        this.project_id = project_id;
    }

    public String getTask() {
        return task;
    }

    public void setTask(String task) {
        this.task = task;
    }

    public int getPercentage() {
        return percentage;
    }

    public void setPercentage(int percentage) {
        this.percentage = percentage;
    }

    public int getTask_status() {
        return task_status;
    }

    public void setTask_status(int task_status) {
        this.task_status = task_status;
    }

    public String getStart() {
        return start;
    }

    public void setStart(String start) {
        this.start = start;
    }

    public String getEnd() {
        return end;
    }

    public void setEnd(String end) {
        this.end = end;
    }


}

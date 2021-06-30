package com.rysaligvera.androidapp;

import com.google.gson.annotations.SerializedName;

public class Supply {

    @SerializedName("supply_id")
    private int supply_id;

    @SerializedName("item")
    private String item;

    @SerializedName("unit")
    private String unit;

    @SerializedName("supplier")
    private String supplier;

    @SerializedName("stocks")
    private int stocks;

    public int getStocks() {
        return stocks;
    }

    public void setStocks(int stocks) {
        this.stocks = stocks;
    }

    public int getSupply_id() {
        return supply_id;
    }

    public void setSupply_id(int supply_id) {
        this.supply_id = supply_id;
    }

    public String getItem() {
        return item;
    }

    public void setItem(String item) {
        this.item = item;
    }

    public String getUnit() {
        return unit;
    }

    public void setUnit(String unit) {
        this.unit = unit;
    }

    public String getSupplier() {
        return supplier;
    }

    public void setSupplier(String supplier) {
        this.supplier = supplier;
    }
}

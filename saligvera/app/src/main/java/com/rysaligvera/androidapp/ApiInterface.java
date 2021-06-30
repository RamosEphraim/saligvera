package com.rysaligvera.androidapp;

import java.util.List;

import okhttp3.MultipartBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;

public interface ApiInterface {

    @GET("projects.php")
    Call<List<Project>> getAllBlogPost();


    @FormUrlEncoded
    @POST("login.php")
    Call<AccountModel> login(
            @Field("username") String username,
            @Field("password") String password);

    @FormUrlEncoded
    @POST("operations.php")
    Call<List<Project>> fetchAllProjects(
            @Field("action") String action,
            @Field("account_id") int account_id);

    @FormUrlEncoded
    @POST("operations.php")
    Call<List<GalleryImage>> fetchAllProjectImages(
            @Field("action") String action,
            @Field("project_id") int project_id);

    @FormUrlEncoded
    @POST("operations.php")
    Call<List<Supply>> fetchAllSupplies(
            @Field("action") String action);

    @FormUrlEncoded
    @POST("operations.php")
    Call<WebResponse> insertSupplyRequest(
            @Field("action") String action,
            @Field("project_id") int project_id,
            @Field("account_id") int account_id,
            @Field("supply_id") int supply_id,
            @Field("quantity") int quantity
            );

    @FormUrlEncoded
    @POST("operations.php")
    Call<WebResponse> insertSupplyRequestV2(
            @Field("action") String action,
            @Field("project_id") int project_id,
            @Field("account_id") int account_id,
            @Field("supply_list") String supply_list,
            @Field("date_need") String date_needed
    );


    @FormUrlEncoded
    @POST("operations.php")
    Call<List<ChecklistItem>> getAllChecklistItems(
            @Field("action") String action,
            @Field("account_id") int account_id,
            @Field("project_id") int project_id );


    @FormUrlEncoded
    @POST("operations.php")
    Call<WebResponse> modifyChecklistStatus(
            @Field("action") String action,
            @Field("account_id") int account_id,
            @Field("pin_code") String pin_code,
            @Field("check_id") int check_id,
            @Field("remarks") String remarks);

    @FormUrlEncoded
    @POST("upload.php")
    Call<WebResponse> upload(
            @Field("filename") String filename,
            @Field("projectID") String projectID,
            @Field("image") String photo
            );

}

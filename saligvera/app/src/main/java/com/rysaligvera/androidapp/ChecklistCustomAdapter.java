package com.rysaligvera.androidapp;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.w3c.dom.Text;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static android.content.Context.MODE_PRIVATE;

public class ChecklistCustomAdapter extends BaseAdapter{
    private Context context;
    private List<ChecklistItem> checklistItemList;
    private static LayoutInflater inflater=null;
    private View view;


    AlertDialog.Builder alertDialogBuilder;
    TextView etchangestatus;
    EditText etpincode;

    ChecklistActivity checklistActivity;
    AlertDialog.Builder rDialog;
    View viewx;
    String pincode = "";

    public ChecklistCustomAdapter(List<ChecklistItem> checklistItems, View view, ChecklistActivity checklistActivity) {
        context= checklistActivity;
        this.checklistActivity = checklistActivity;
        this.checklistItemList = checklistItems;
        inflater = ( LayoutInflater )context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        this.view = view;

        alertDialogBuilder = new AlertDialog.Builder(context);
        alertDialogBuilder.setTitle("Enter your Pincode");

        alertDialogBuilder.setView(view);

        etchangestatus = view.findViewById(R.id.etchangestatus);
        etpincode = view.findViewById(R.id.etpincode);

        rDialog = new AlertDialog.Builder(context);

        LayoutInflater inflater = ( LayoutInflater )context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        viewx = inflater.inflate(R.layout.layout_dialog_remarks, null);

        rDialog.setView(viewx).setTitle("Leave a remark");



    }
    @Override
    public int getCount() {
        return checklistItemList.size();
    }

    @Override
    public Object getItem(int position) {
        return checklistItemList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return checklistItemList.get(position).getCheck_id();
    }

    public void setData(List<ChecklistItem> contacts) {
        this.checklistItemList = contacts;
    }

    public ChecklistItem getData(int position) {
        return checklistItemList.get(position);
    }

    public List<ChecklistItem> getCheckedDataset() {
        List<ChecklistItem> checkedListItem = new ArrayList<>();
        for (ChecklistItem contact: checklistItemList){
            if(contact.isChecked())
                checkedListItem.add(contact);
        }
        return checkedListItem;
    }

    public class Holder
    {
        CheckBox task_name;
        TextView task_status;
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        ChecklistCustomAdapter.Holder holder= new ChecklistCustomAdapter.Holder();
        View rowView;
        rowView = inflater.inflate(R.layout.row_checklist_item, null);


        holder.task_name= rowView.findViewById(R.id.task_name);
        holder.task_status= rowView.findViewById(R.id.task_status);

        holder.task_status.setText(checklistItemList.get(position).getStatus());

        holder.task_name.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(view.getParent() != null){
                    ((ViewGroup) view.getParent()).removeView(view);
                }




                etchangestatus.setText(String.format("Task %s will change the status. If you wish to proceed, ", checklistItemList.get(position).getTask()));
                alertDialogBuilder
                        .setCancelable(false)
                        .setPositiveButton("Change Status",
                                new DialogInterface.OnClickListener() {
                                    public void onClick(DialogInterface dialog,int id) {
                                        pincode = etpincode.getText().toString().trim();

                                        if(pincode.equals("")) {
                                            Toast.makeText(context, "Please fill up required fields!", Toast.LENGTH_SHORT).show();
                                        }else{
                                            //send request here.


                                            rDialog.setPositiveButton("Submit", new DialogInterface.OnClickListener() {
                                                @Override
                                                public void onClick(DialogInterface dialogInterface, int i) {


                                                    final ProgressDialog progressDialog = new ProgressDialog(context);
                                                    progressDialog.setTitle("Changing Status...");
                                                    progressDialog.setMessage("Please wait...");
                                                    progressDialog.setCancelable(false);
                                                    progressDialog.show();

                                                    TextView x = viewx.findViewById(R.id.txtRemarks);
                                                    SharedPreferences prefs = context.getSharedPreferences(AppConstants.SHARED_PREFS_NAME, MODE_PRIVATE);
                                                    int account_id = prefs.getInt("account_id", 0);
                                                    ApiInterface service = ApiClient.getClient().create(ApiInterface.class);
                                                    Call<WebResponse> call = service.modifyChecklistStatus(
                                                            "modifyChecklistStatus",
                                                            account_id, pincode,
                                                            checklistItemList.get(position).getCheck_id(),
                                                            x.getText().toString()
                                                            );
                                                    call.enqueue(new Callback<WebResponse>() {
                                                        @Override
                                                        public void onResponse(Call<WebResponse> call, Response<WebResponse> response) {
                                                            if(response.isSuccessful()){
                                                                if(response.body().isSuccess())
                                                                {
                                                                    boolean newState = !checklistItemList.get(position).isChecked();
                                                                    checklistItemList.get(position).setChecked(newState);
                                                                    checklistActivity.loadChecklistItems();
                                                                    Toast.makeText(context, response.body().getMessage() , Toast.LENGTH_LONG).show();
                                                                }else {
                                                                    checklistActivity.loadChecklistItems();
                                                                    Toast.makeText(context, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                                                                }
                                                            }else{
                                                                Toast.makeText(context, "Something went wrong...Please try later!", Toast.LENGTH_SHORT).show();
                                                            }
                                                            progressDialog.dismiss();
                                                        }
                                                        @Override
                                                        public void onFailure(Call<WebResponse> call, Throwable t) {
                                                            progressDialog.dismiss();
                                                            Toast.makeText(context, "Something went wrong...Please try later!" + t.toString(), Toast.LENGTH_SHORT).show();
                                                        }
                                                    });
                                                }
                                            });

                                            AlertDialog alx = rDialog.create();
                                            alx.show();
                                        }
                                    }
                                })
                        .setNegativeButton("Cancel",
                                new DialogInterface.OnClickListener() {
                                    public void onClick(DialogInterface dialog,int id) {
                                        dialog.cancel();
                                    }
                                });

                AlertDialog alertDialog = alertDialogBuilder.create();
                alertDialog.show();
            }
        });


        if(checklistItemList.get(position).getTask_status() == 2) {
            holder.task_name.setText(  " [" + checklistItemList.get(position).getPercentage() + "% ] - " + checklistItemList.get(position).getTask() + " (Not Started)");
            holder.task_name.setEnabled(false);
        }else if(checklistItemList.get(position).getTask_status() == 1) {
            holder.task_name.setText( " [" + checklistItemList.get(position).getPercentage() + "% ] - " +  checklistItemList.get(position).getTask() + "( " + checklistItemList.get(position).getStart() + ")");
            checklistItemList.get(position).setChecked(false);
        }else if(checklistItemList.get(position).getTask_status() == 0) {
            checklistItemList.get(position).setChecked(true);

            holder.task_name.setText(String.format("%s \n(%s - %s) ", (" [" + checklistItemList.get(position).getPercentage() + "% ] - " +  checklistItemList.get(position).getTask()),
                    checklistItemList.get(position).getStart(), checklistItemList.get(position).getEnd()));

        }

        holder.task_name.setChecked(checklistItemList.get(position).isChecked());

        return rowView;
    }
}

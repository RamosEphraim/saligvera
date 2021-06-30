package com.rysaligvera.androidapp;


import com.google.gson.annotations.SerializedName;

public class AccountModel
{
    @SerializedName("pincode")
    private String pincode;

    @SerializedName("middlename")
    private String middlename;

    @SerializedName("account_id")
    private int account_id;

    @SerializedName("email")
    private String email;

    @SerializedName("role")
    private String role;

    @SerializedName("surname")
    private String surname;

    @SerializedName("firstname")
    private String firstname;

    @SerializedName("code")
    private String code;

    @SerializedName("contact")
    private String contact;

    public String getPincode ()
    {
        return pincode;
    }

    public void setPincode (String pincode)
    {
        this.pincode = pincode;
    }

    public String getMiddlename ()
    {
        return middlename;
    }

    public void setMiddlename (String middlename)
    {
        this.middlename = middlename;
    }

    public int getAccount_id ()
    {
        return account_id;
    }

    public void setAccount_id (int account_id)
    {
        this.account_id = account_id;
    }

    public String getEmail ()
    {
        return email;
    }

    public void setEmail (String email)
    {
        this.email = email;
    }

    public String getRole ()
    {
        return role;
    }

    public void setRole (String role)
    {
        this.role = role;
    }

    public String getSurname ()
    {
        return surname;
    }

    public void setSurname (String surname)
    {
        this.surname = surname;
    }

    public String getFirstname ()
    {
        return firstname;
    }

    public void setFirstname (String firstname)
    {
        this.firstname = firstname;
    }

    public String getCode ()
    {
        return code;
    }

    public void setCode (String code)
    {
        this.code = code;
    }

    public String getContact ()
    {
        return contact;
    }

    public void setContact (String contact)
    {
        this.contact = contact;
    }

    @Override
    public String toString()
    {
        return "ClassPojo [pincode = "+pincode+", middlename = "+middlename+", account_id = "+account_id+", email = "+email+", role = "+role+", surname = "+surname+", firstname = "+firstname+", code = "+code+", contact = "+contact+"]";
    }
}
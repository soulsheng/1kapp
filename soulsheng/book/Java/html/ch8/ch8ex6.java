import java.util.*;
import java.io.*;
class Account{
	private String name;
	private String ID;
	private double balance;
	private int overdraftNum;
	private double withdrawAndSave[]=new double[1000];
	private double overdraftLimit;
	private int index;
	public Account(){
		name=null;
	}
	public Account(String idNum,String n,double over)throws Exception{
		if(idNum.length()!=16)
			throw new Exception("ID number should be 16 digits");
		else{
			for(int j=0;j<idNum.length();j++){
				char c=idNum.charAt(j);
				if(c<'0'||c>'9')
					throw new Exception("ID number should be all digit");
			}
		}
		name=n;ID=idNum;index=0;balance=0.0;overdraftNum=0;
		if(over<=0)
			overdraftLimit=0.0;
		else
			overdraftLimit=over;
		for(int j=0;j<withdrawAndSave.length;j++)
			withdrawAndSave[j]=0.0;
	}
	public int compareID(Account a){
		return ID.compareTo(a.getID());
	}

	public boolean equalsID(Account a){
		return ID.equals(a.ID);
	}
	public double saveMoney(double m){
		withdrawAndSave[index++]=m;
		balance=balance+m;return balance;
	}
	public double getMoney(double m)throws Exception{
		if((balance-m)<0)
			throw new Exception(ID+" card has not enough money in account");
		else{
			withdrawAndSave[index++]=-m;
			balance=balance-m;
		}
		return balance;
	}
	public double cunsumed(double m)throws Exception{
		if((balance+overdraftLimit-m)<0)
			throw new Exception(ID+" card is greater than overdraf
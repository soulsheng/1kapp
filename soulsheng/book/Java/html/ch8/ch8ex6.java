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
			throw new Exception(ID+" card is greater than overdraft limit");
		else{
			withdrawAndSave[index++]=-m;overdraftNum++;
			balance=balance-m;
		}
		return balance;
	}
	public double getBalance(){
		return balance;
	}
	public String getID(){
		return ID;
	}
	public int getOverdraftNum(){
		return overdraftNum;
	}
	public void display(){
		System.out.println(ID+"      "+name);
		double temp=withdrawAndSave[0];
		System.out.println(withdrawAndSave[0]+"         "+temp);
		for(int j=1;j<index;j++){
			temp=withdrawAndSave[j]+temp;
			if(withdrawAndSave[j]>0)
				System.out.println(withdrawAndSave[j]+"         "+temp);
			else
				System.out.println("      "+withdrawAndSave[j]+"  "+temp);
		}
	}
	public void putAccount(PrintWriter pw)throws Exception{
		String s=name+"/"+ID+"/"+balance+"/"+overdraftNum+"/"+overdraftLimit+"/"+index;
		for(int j=0;j<index;j++)
			s=s+"/"+withdrawAndSave[j];
		pw.println(s);
	}
	public void getDetails(String s)throws Exception{
		StringTokenizer t=new StringTokenizer(s,"/");
		name=t.nextToken();
		ID=t.nextToken();
		balance=Double.parseDouble(t.nextToken());
		overdraftNum=Integer.parseInt(t.nextToken());
		overdraftLimit=Double.parseDouble(t.nextToken());
		index=Integer.parseInt(t.nextToken());
		for(int j=0;j<index;j++){
			withdrawAndSave[j]=Double.parseDouble(t.nextToken());
		}
	}
}

class Bank{
	private Vector bankAccount;
	public Bank(){
		bankAccount=new Vector();
	}
	public void addAccount(Account a)throws Exception{
		boolean found=checkID(a);
		if(!found){
			int j=0;boolean posFnd=false;
			while(j<bankAccount.size()&&!posFnd){
				Account ac=(Account)bankAccount.elementAt(j);
				if(a.compareID(ac)>0)
					j++;
				else
					posFnd=true;
			}
			bankAccount.insertElementAt(a,j);
		}else
			throw new Exception(a.getID()+" card is duplicate");
	}
	private boolean checkID(Account a){
		boolean fnd=false;;int j=0;
		Account a1;
		while(j<bankAccount.size()&!fnd){
			a1=(Account)bankAccount.elementAt(j);
			if(a1.equalsID(a))
				fnd=true;
			else
				j++;
		}
		return fnd;
	}
	private Account searchAccount(String idNum){
		Account a1=null;boolean fnd=false;
		for(int j=0;j<bankAccount.size()&&!fnd;j++){
			a1=(Account)bankAccount.elementAt(j);
			if(idNum.equals(a1.getID()))
				fnd=true;
		}
		if(fnd)
			return a1;
		else
			return null;
	}
	public double save(double m,String idNum)throws Exception{
		Account a;
		a=searchAccount(idNum);
		if(a!=null)
			return a.saveMoney(m);
		else
			throw new Exception(idNum+" card is not exist")	;
	}
	public double get(double m,String idNum)throws Exception{
		Account a;
		a=searchAccount(idNum);
		if(a!=null)
			return a.getMoney(m);
		else
			throw new Exception(idNum+" card is not exist")	;
	}
	public double consume(double m,String idNum)throws Exception{
		Account a;
		a=searchAccount(idNum);
		if(a!=null)
			return a.cunsumed(m);
		else
			throw new Exception(idNum+" card is not exist");
	}
	public void deleteAccount(String idNum)throws Exception{
		Account a;
		a=searchAccount(idNum);
		if(a!=null){
			if(a.getBalance()!=0)
				throw new Exception(idNum+" card has balance so can not delete");
			else{
				boolean fnd=false;Account a1=null;
				for(int j=0;j<bankAccount.size()&&!fnd;j++){
					a1=(Account)bankAccount.elementAt(j);
					if(idNum.equals(a1.getID())){
						fnd=true;
						bankAccount.removeElementAt(j);
					}
				}
			}
		}else
			throw new Exception(idNum+" card is not exist");
	}
	public void showIndividualAccount(String idNum)throws Exception{
		Account a;
		a=searchAccount(idNum);
		if(a!=null)
			a.display();
		else
			throw new Exception(idNum+" card is not exist");
	}
	public double statTotalBalance()throws Exception{
		Account a1=null;double d=0.0;
		for(int j=0;j<bankAccount.size();j++){
			a1=(Account)bankAccount.elementAt(j);
			d=d+a1.getBalance();
		}
		return d;
	}
	public int showIndividualOverdraftTime(String idNum)throws Exception{
		Account a;
		a=searchAccount(idNum);
		if(a!=null)
			return a.getOverdraftNum();
		else
			throw new Exception(idNum+" card is not exist");
	}	
	public double checkBalance(String idNum)throws Exception{
		Account a;
		a=searchAccount(idNum);
		if(a!=null)
			return a.getBalance();
		else
			throw new Exception(idNum+" card is not exist");
	}
	public void checkOverdraftAccount(){
		Account a1=null;
		for(int j=0;j<bankAccount.size();j++){
			a1=(Account)bankAccount.elementAt(j);
			if(a1.getBalance()<0)
				a1.display();
		}
	}
	public void showAccount(){
		System.out.println("Account List:");
		Account a1;
		for(int j=0;j<bankAccount.size();j++){
			a1=(Account)bankAccount.elementAt(j);
			a1.display();
		}
		System.out.print("Enter a any character to continue:");
		char c=Keyboard.readChar();
	}
	public void saveAccountBank(File f)throws Exception{
		FileWriter fw=new FileWriter(f);
		PrintWriter fd=new PrintWriter(fw);
		Account a1;
		System.out.println("Save Account......");
		int j=0;
		while(j<bankAccount.size()){
			a1=(Account)bankAccount.elementAt(j);
			a1.putAccount(fd);
			j++;
		}
		fd.close();
	}
	public void loadBankAccount(File f)throws Exception{
		FileReader fr=new FileReader(f);
		BufferedReader fd=new BufferedReader(fr);
		System.out.println("Load Account......");
		String s=fd.readLine();
		while(s!=null){
			Account a1=new Account();
			a1.getDetails(s);
			bankAccount.addElement(a1);
			s=fd.readLine();
		}
		fd.close();
	}	
}

public class ch8ex6{
	public static void main(String[]args){
		Bank bk=new Bank();
		File bankFile=new File("BankAccount.txt");
		boolean con=true;;
		while(con){
			try{
				int opt;
				opt=menu();
				switch (opt){
					case 1:
						Account a1=getDetails();
						bk.addAccount(a1);
						break;
					case 2:
						System.out.print("Enter a ID number: ");
						String n1=Keyboard.readString();
						System.out.print("Enter how much do you save: ");
						double d1=Keyboard.readDouble();
						double db1=bk.save(d1,n1);
						System.out.println("The balance is: "+db1);
						break;
					case 3:
						System.out.print("Enter a ID number: ");
						String n2=Keyboard.readString();
						System.out.print("Enter how much do you need: ");
						double d2=Keyboard.readDouble();
						double db2=bk.get(d2,n2);
						System.out.println("The balance is: "+db2);
						break;
					case 4:
						System.out.print("Enter a ID number: ");
						String n3=Keyboard.readString();
						System.out.print("Enter how much do you get: ");
						double d3=Keyboard.readDouble();
						double db3=bk.consume(d3,n3);
						System.out.println("The balance is: "+db3);
						break;
					case 5:
						System.out.print("Enter a ID number: ");
						String n4=Keyboard.readString();
						bk.deleteAccount(n4);
						break;
					case 6:
						System.out.print("Enter a ID number: ");
						String n5=Keyboard.readString();
						double db4=bk.checkBalance(n5);
						System.out.println(n5+"  the balance is: "+db4);
						break;
					case 7:
						System.out.print("Enter a ID number: ");
						String n6=Keyboard.readString();
						bk.showIndividualAccount(n6);
						break;
					case 8:
						bk.showAccount();
						break;
					case 9:
						System.out.print("Enter a ID number: ");
						String n7=Keyboard.readString();
						int x=bk.showIndividualOverdraftTime(n7);
						System.out.println("The overdraft time is: "+x);
						break;
					case 10:
						bk.checkOverdraftAccount();
						break;
					case 11:
						double db5=bk.statTotalBalance();
						System.out.println("The total of balance is: "+db5);
						break;
					case 12:
						if(!bankFile.exists())
							bankFile.createNewFile();
						bk.saveAccountBank(bankFile);
						break;
					case 13:
						if(!bankFile.exists())
							throw new Exception(" BankAccount.txt file is not exist");
						else
							bk.loadBankAccount(bankFile);
						break;
					case 14:con=false;break;
					default:System.out.println("Invalid input");
				}
			}catch(Exception e){
				System.out.println(e.getMessage());
			}
		}
	}
	static int menu(){
		int cho;
		System.out.println("------------Bank Account Operation Menu------------");
		System.out.println();
		System.out.println("   1:  Add New Account");
		System.out.println("   2:  Save Money");
		System.out.println("   3:  Withdraw Money");
		System.out.println("   4:  Consume");
		System.out.println("   5:  Delete Account");
		System.out.println("   6:  Check Balance");
		System.out.println("   7:  Display Individual Account");
		System.out.println("   8:  Display Total Account");
		System.out.println("   9:  Check Individual Overdraft Time");
		System.out.println("   10: Check Overdraft Account");
		System.out.println("   11: Stat Bank Balance");
		System.out.println("   12: Save Before exit");
		System.out.println("   13: Load Before execute");
		System.out.println("   14: Exit");
		System.out.println("---------------------------------------------------");
		System.out.print("Enter your Choice: ");
		cho=Keyboard.readInt();
		return cho;
	}
	static Account getDetails()throws Exception{
		System.out.print("Name: ");
		String n=Keyboard.readString();
		System.out.print("ID Number: ");
		String idNum=Keyboard.readString();
		System.out.print("Overdraft Limited: ");
		double over=Keyboard.readDouble();
		Account a=new Account(idNum,n,over);
		return a;
	}
}

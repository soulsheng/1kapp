import java.util.*;
class TelephoneEntry{
	private String name;
	private String officeTelephone;
	private String homeTelephone;
	private String mobileTelephone;
	private String shortMobileTelephone;
	private String organization;
	private String title;
	private String zipCode;
	private String mailAddress;
	private int queueNum;
	public TelephoneEntry(String n,String o,String h,String mb,String smt,String or,String ti,String zi,String ma){
		queueNum=0;name=n;
		officeTelephone=o;
		homeTelephone=h;
		mobileTelephone=mb;
		shortMobileTelephone=smt;
		organization=or;
		title=ti;
		zipCode=zi;
		mailAddress=ma;
	}
	public void display(){
		System.out.println("name: "+name);
		System.out.println("officeTelephone: "+officeTelephone);
		System.out.println("homeTelephone: "+homeTelephone);
		System.out.println("mobileTelephone: "+mobileTelephone);
		System.out.println("shortMobileTelephone: "+shortMobileTelephone);
		System.out.println("organization: "+organization);
		System.out.println("title: "+title);
		System.out.println("zipCode: "+zipCode);
		System.out.println("mailAddress: "+mailAddress);
		System.out.println("queueNum: "+queueNum);
	}
	public boolean equalsName(TelephoneEntry t){
		return name==t.name;
	}
	public boolean equalsName(String n){
		return name.equals(n);
	}
	public void incQueueNum(){
		queueNum++;
	}
	public int compareName(TelephoneEntry t){
		return name.compareTo(t.getName());
	}
	public String getName(){
		return name;
	}
}

class TelephoneDirectory{
	private Vector record;
	public TelephoneDirectory(){
		record=new Vector();
	}
	public boolean addNewEntry(TelephoneEntry t){
		boolean found=checkName(t);
		if(!found){
			int j=0;boolean posFnd=false;
			while(j<record.size()&&!posFnd){
				TelephoneEntry te=(TelephoneEntry)record.elementAt(j);
				if(t.compareName(te)>0)
					j++;
				else
					posFnd=true;
			}
			record.insertElementAt(t,j);
			return true;
		}else
			return false;
	}
	private boolean checkName(TelephoneEntry t){
		boolean fnd=false;;int j=0;
		TelephoneEntry t1;
		while(j<record.size()&!fnd){
			t1=(TelephoneEntry)record.elementAt(j);
			if(t1.equalsName(t))
				fnd=true;
			else
				j++;
		}
		return fnd;
	}
	public boolean searchDirectorEntry(String n){
		boolean fnd=false;int j=0;
		TelephoneEntry t;
		while(j<record.size()&&!fnd){
			t=(TelephoneEntry)record.elementAt(j);
			if(t.equalsName(n))
				fnd=true;
			else
				j++;
		}
		if(fnd){
			t=(TelephoneEntry)record.elementAt(j);
			t.display();
			t.incQueueNum();
			return true;
		}else
			return false;
	}
	public boolean deleteEntry(String n){
		boolean fnd=false;int j=0;
		TelephoneEntry t;
		while(j<record.size()&&!fnd){
			t=(TelephoneEntry)record.elementAt(j);
			if(t.equalsName(n))
				fnd=true;
			else
				j++;
		}
		if(fnd){
			record.removeElementAt(j);
			return true;
		}else
			return false;
	}
	public void showDirectory(){
		TelephoneEntry t;
		for(int j=0;j<record.size();j++){
			t=(TelephoneEntry)record.elementAt(j);
			t.display();
		}
	}
}
class Menu{
	String items[];
	String title;
	public Menu(String f[],String t){
		items=f;title=t;
	}
	public int showMenu(){
		int val;
		System.out.println();
		for(int j=0;j<items.length;j++)
			System.out.println("     "+(j+1)+"."+items[j]);
		System.out.print("     Enter your choice:");
		val=Keyboard.readInt();
		return val;
	}
}
public class ch6ex23{
	public static void main(String[]args){
		TelephoneDirectory directory=new TelephoneDirectory();
		String opts[]={"New User","Delete User","Search","List Directory","Exit"};
		Menu menu=new Menu(opts,"Directory Menu");
		int opt;
		opt=menu.showMenu();
		while(opt!=5){
			switch(opt){
				case 1:
					TelephoneEntry t1=getDetails();
					if(!directory.addNewEntry(t1))
						System.out.println("Duplicate name");
					break;
				case 2:
					System.out.print("Enter deleted name: ");
					String n1=Keyboard.readString();
					if(directory.deleteEntry(n1))
						System.out.println("Deleted successful");
					else
						System.out.println(n1+" is not exit");
					break;
				case 3:
					System.out.print("Enter searched name: ");
					String n2=Keyboard.readString();
					if(!directory.searchDirectorEntry(n2))
						System.out.println(n2+" is not exit");
					break;
				case 4:
					directory.showDirectory();
					break;
				case 5:break;
					default:opt=menu.showMenu();
			}
			opt=menu.showMenu();
		}
	}
	static TelephoneEntry getDetails(){
		System.out.println("Name: ");
		String n=Keyboard.readString();
		System.out.println("officeTelephone: ");
		String ot=Keyboard.readString();
		System.out.println("homeTelephone: ");
		String ht=Keyboard.readString();
		System.out.println("mobileTelephone: ");
		String mt=Keyboard.readString();
		System.out.println("shortMobileTelephone: ");
		String smt=Keyboard.readString();
		System.out.println("organization: ");
		String org=Keyboard.readString();
		System.out.println("title: ");
		String tit=Keyboard.readString();
		System.out.println("zipCode: ");
		String zip=Keyboard.readString();
		System.out.println("mailAddress: ");
		String ma=Keyboard.readString();
		TelephoneEntry t=new TelephoneEntry(n,ot,ht,mt,smt,org,tit,zip,ma);
		return t;
	}
}
class Date{
	private int day;int month;int year;
	public Date(int d,int m,int y){
		day=d;month=m;year=y;
	}
	public String toString(){
		String dte;
		dte=day+"/"+month+"/"+year;
		return dte;
	}
}
class employee{
	private String name;
	private Date born;
	public employee(String n,int d,int m,int y){
		name=n;
		born=new Date(d,m,y);
	}
	public void display(){
		System.out.println(name);
		System.out.println(born.toString());
	}
}
public class ch6ex16{
	public static void main(String[]args){
		employee e1=new employee("Richard",24,11,2004);
		e1.display();
	}
}	
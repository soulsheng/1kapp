class employee{
	private String name;
	public String dept;
	static String position;
	public employee(String n,String p){
		name=n;position=p;
	}
	public void display(String ob){
		System.out.println(ob+" private name: "+name);
		System.out.println(ob+ " static position: "+position);
	}
}
public class ch6ex3{
	public static void main(String[]args){
		employee e1=new employee("Richard","Project Mangager");
		employee e2=new employee("Stephen","Programmer");
		e1.dept="Development";
		e2.dept="Market";
		e1.display("e1");
		e2.display("e2");
		System.out.println("e1 Department: "+e1.dept);
		System.out.println("e2 Department: "+e2.dept);
	}
}		
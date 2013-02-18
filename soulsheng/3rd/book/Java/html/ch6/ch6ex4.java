class student{
	private String name;
	private String telephone;
	public student(String n,String t){
		telephone=t;
		name=capitalizes(n);
	}
	public void display(){
		System.out.println("name: "+name);
		System.out.println("telephone: "+telephone);
	}
	private String capitalizes(String n1){
		char k=n1.charAt(0);
		k=Character.toUpperCase(k);
		return(k+n1.substring(1));
	}
}
public class ch6ex4{
	public static void main(String[]args){
		student s1=new student("richard","12345678");
		s1.display();
	}
}		
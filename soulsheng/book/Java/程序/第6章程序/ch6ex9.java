class encapsulation{
	private String name;
	public int age;
	public encapsulation(){
		name="private";
		age=23;
	}
	public void display(){
		System.out.println(temp);
		System.out.println(name);
		System.out.println(inc());
	}
	private int inc(){
		int temp;
		temp=age+1;
		return temp;
	}
}
public class ch6ex9{
	public static void main(String[]args){
		encapsulation e1=new encapsulation();
		e1.display();
		e1.age++;
		e1.display();
		e1.inc();
		System.out.println(e1.name);
	}
}
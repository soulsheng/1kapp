class Teacher{
	private String name;
	private int age;
	private String department;
	private String title;
	private class Course{
		private String cc[]=new String[6];
		private int cch[]=new int[6];
		public Course(String c1[],int ch1[]){
			for(int j=0;j<cc.length;j++){
				cc[j]=c1[j];cch[j]=ch1[j];
			}
		}
		public void display(){
			for(int j=0;j<cc.length;j++)
				System.out.println(cc[j]+"  "+cch[j]);
		}
	}
	Course co;	
	public Teacher(String n,int a,String d,String t,String c[],int h[]){
		name=n;age=a;
		department=d;
		title=t;
		co=new Course(c,h);
	}
	public void display(){
		System.out.println(name+" "+age+" "+department+" "+title);
		co.display();
		for(int j=0;j<co.cc.length;j++)
			System.out.println(co.cc[j]+"  "+co.cch[j]);
	}
}
public class ch6ex17{
	public static void main(String[]args){
		String coo[]={"math","computing","graphics","interface","network","english"};
		int coh[]={96,48,48,64,64,102};
		Teacher t1=new Teacher("Richard",41,"Computing Science","Professor",coo,coh);
		t1.display();
	}
}		
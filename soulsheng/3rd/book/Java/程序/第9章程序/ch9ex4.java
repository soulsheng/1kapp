class Person{
	private String name;
	private long SIN;
	private int age;
	public Person(String n,long sin,int a){
		name=n;SIN=sin;age=a;
	}
	public Person(){
		name=null;SIN=0;age=0;
	}
	public String getName(){return name;}
	public long getSIN(){return SIN;}
	public void display(){
		System.out.println("Name  :"+name);
		System.out.println("Social Security Number  :"+SIN);
		System.out.println("Age  :"+age);
	}
}
class Teacher extends Person{
	private String degree;
	public Teacher(String n,long sin,int a,String d){
		super(n,sin,a);degree=d;
	}
	public String getDegree(){return degree;}
	public void display(){
		super.display();
		System.out.println("Degree  :"+degree);
	}
}
class Student extends Person{
	private double gradePointAverage;
	public Student(String n,long sin,int a){
		super(n,sin,a);gradePointAverage=0;
	}
	public void putGrade(double g){gradePointAverage=g;}
	public double getGrade(){return gradePointAverage;}
	public void display(){
		super.display();
		System.out.println("Grade Point Average  :"+gradePointAverage);
	}
}
class PartTimeStudent extends Student{
	private double creditHoursLearned;
	public PartTimeStudent(String n,long sin,int a){
		super(n,sin,a);creditHoursLearned=0;
	}
	public void putCreditHoursLearned(double h){
		creditHoursLearned=creditHoursLearned+h;
	}
	public void display(){
		super.display();
		System.out.println("Credit Hours Learned  :"+creditHoursLearned);
	}
}
class FullTimeStudent extends Student{
	private int level;
	public FullTimeStudent(String n,long sin,int a){
		super(n,sin,a);level=0;
	}
	public void putLevel(int l){
		level=l;
	}
	public void display(){
		super.display();
		System.out.println("Level  :"+level+" grade");
	}
}
class PartTimeTeacher extends Teacher{
	private double rate;
	private int totalHours;
	public PartTimeTeacher(String n,long sin,int a,String d,double r){
		super(n,sin,a,d);rate=r;totalHours=0;
	}
	public void putHoursWorked(int h){
		totalHours=totalHours+h;
	}
	public void pay(){
		super.display();
		System.out.println("Gross pay  :"+rate*totalHours);
	}
}
class FullTimeTeacher extends Teacher{
	private double monthSalarys;
	private double workload;
	private double overWorkloadRate;
	public FullTimeTeacher(String n,long sin,int a,String d,double m,double o){
		super(n,sin,a,d);monthSalarys=m;overWorkloadRate=o;workload=0.0;
	}
	public void putWorkload(double w){
		workload=w;
	}

	public void pay(){
		super.display();
		if(workload>=220.0)
			System.out.println("Gross pay  :"+(monthSalarys+overWorkloadRate*(workload-220)/12));
		else
			System.out.println("Gross pay  :"+(monthSalarys*(workload/220)));		
	}
}
class Staff extends Teacher{
	private double monthSalarys;
	private int workDaysInMonth;
	private double overWorkloadRate;
	public Staff(String n,long sin,int a,String d,double m,double o){
		super(n,sin,a,d);monthSalarys=m;overWorkloadRate=o;workDaysInMonth=0;
	}
	public void putWorkDaysInMonth(int m){
		workDaysInMonth=m;
	}

	public void pay(){
		super.display();
		if(workDaysInMonth>=22)
			System.out.println("Gross pay  :"+(monthSalarys+overWorkloadRate*(workDaysInMonth-22)));
		else
			System.out.println("Gross pay  :"+(monthSalarys*(workDaysInMonth/22)));		
	}
}

public class ch9ex4{
	public static void main(String[]args){
		PartTimeTeacher teacher1=new PartTimeTeacher("Richard",123456789,35,"Master",100.0);
		FullTimeTeacher teacher2=new FullTimeTeacher("Grant",234567891,54,"PH.D",6000.0,70);
		Staff teacher3=new Staff("Jerry",321456789,28,"Bachelor",3000,100);
		PartTimeStudent student1=new PartTimeStudent("Gerry",432156789,21);
		FullTimeStudent student2=new FullTimeStudent("Bruno",124357689,19);
		teacher1.putHoursWorked(125);
		teacher2.putWorkload(300);
		teacher3.putWorkDaysInMonth(24);
		student1.putCreditHoursLearned(80.0);
		student1.putCreditHoursLearned(40.0);
		student1.putGrade(2.45);
		student2.putGrade(3.1);
		student2.putLevel(2);
		teacher1.pay();
		teacher2.pay();
		teacher3.pay();
		student1.display();
		student2.display();
	}
}
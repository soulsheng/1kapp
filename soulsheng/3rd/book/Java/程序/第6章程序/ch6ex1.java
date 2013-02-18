class Student{
	private String name;//学生姓名
	private int age;//年龄
	private int serialNumber;//学号
	private double cores[]=new double[50];//课程考试分数
	private String subjects[]=new String[50];//课程名称
	private boolean status[]=new boolean[5];//true表示对应课程已修
	private String subject;//专业
	private int remove;//班级
	private String faculty;//系
	public Student(String n,String s,String f,int se,int r,int a){
		name=n; subject=s; faculty=f;
		serialNumber=se; remove=r;age=a;
	}
	public void display(){
		System.out.println("name: "+name);
		System.out.println("faculty: "+faculty);
		System.out.println("class: "+remove);
		System.out.println("age: "+age);
	}
}
public class ch6ex1{
	public static void main(String[]args){
		Student s1=new Student("Richard","Computing","Information",12,1,19);
		s1.display();
	}
}
class Student{
	private String name;//ѧ������
	private int age;//����
	private int serialNumber;//ѧ��
	private double cores[]=new double[50];//�γ̿��Է���
	private String subjects[]=new String[50];//�γ�����
	private boolean status[]=new boolean[5];//true��ʾ��Ӧ�γ�����
	private String subject;//רҵ
	private int remove;//�༶
	private String faculty;//ϵ
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
//DemoTreeSet.java
import java.util.*;
class Student implements Comparable{
	String sid;
	int grade;
	String name;
	public Student(String sid,String sname,int grade){
		this.sid=sid;
		this.name=sname;
		this.grade=grade;}
	public int compareTo(Object o){
		Student s=(Student)o;
		return grade-s.grade;}
		public int getGrade(){return grade;}
		public String getSid(){return sid;}
		public String getName(){return name;}
	}

public class DemoTreeSet{
	public static void main(String[] args){
		SortedSet students=new TreeSet();
		students.add(new Student("00001A","Tom",89));
		students.add(new Student("00302B","Jike",95));
		students.add(new Student("01007A","Lucy",70));
		students.add(new Student("04010A","Anny",80));
		System.out.println("Sorted by grade:");
		System.out.println("Sid\t Sname\tGrade");
		Iterator iter1=students.iterator();
		while(iter1.hasNext()){
		Student stemp=(Student)(iter1.next());
		System.out.println(stemp.getSid()+"\t"+stemp.getName()+"\t"+stemp.getGrade());}
		SortedSet sortBySid=new TreeSet(new Comparator( )
		{public int compare(Object a,Object b)
			{
				Student s1=(Student)a;
				Student s2=(Student)b;
				String sid1=s1.getSid( );
				String sid2=s2.getSid( );
				return sid1.compareTo(sid2);
		}
	});
		sortBySid.addAll(students);
		Iterator iter2=sortBySid.iterator();
		System.out.println("Sorted by Sid:");
		System.out.println("Sid\t Sname\tGrade");
		while(iter2.hasNext()){
			Student stemp=(Student)(iter2.next());
			System.out.println(stemp.getSid()+"\t"+stemp.getName()+"\t"+stemp.getGrade());}
	}
}

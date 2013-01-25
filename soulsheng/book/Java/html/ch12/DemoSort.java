import java.util.*;
class Faculty implements Comparable{
	String fid;
	double salary;
	String fname;
	public Faculty(String fid,String fname,double salary){
		this.fid=fid;
		this.fname=fname;
		this.salary=salary;}

	public int compareTo(Object o){
		Faculty f=(Faculty)o;
		String cfid=f.getFid( );
		return fid.compareTo(cfid);
		}

	public double getSalary(){return salary;}
	public String getFid(){return fid;}
	public String getName(){return fname;}
	}

public class DemoSort{
	public static void main(String[] args){
		List faculties=new LinkedList();
		faculties.add(new Faculty("08361","Tom",1890.98));
		faculties.add(new Faculty("07651","Jike",3995.75));
		faculties.add(new Faculty("08233","Lucy",2070.62));
		faculties.add(new Faculty("06163","Anny",2070.62));
		System.out.println("Faculties befor sorting:");
		System.out.println("fid\t fname\tSalary");
		Iterator iter1=faculties.iterator();
	
		while(iter1.hasNext()){
		Faculty ftemp=(Faculty)(iter1.next());
		System.out.println(ftemp.getFid()+"\t"+ftemp.getName()+"\t"+ftemp.getSalary());}
		Collections.sort(faculties);
		System.out.println("Faculties sorted by fid:");
		System.out.println("fid\t fname\tSalary");
		
		Iterator iter2=faculties.iterator();
		while(iter2.hasNext()){
		Faculty ftemp=(Faculty)(iter2.next());
		System.out.println(ftemp.getFid()+"\t"+ftemp.getName()+"\t"+ftemp.getSalary());}
		
		Collections.sort(faculties,new Comparator( )
		{public int compare(Object a,Object b)
			{ 	Faculty F1=(Faculty)a;
			        Faculty F2=(Faculty)b;
				double DiffSalary=F1.salary-F2.salary;
				if (DiffSalary>0)return 1;
				if (DiffSalary<0)return -1;
		        	else return 0;			
			}
			
		});
		Iterator it=faculties.iterator();
		System.out.println("Faculties sorted by salary:");
		System.out.println("fid\t fname\tsalary");
		while(it.hasNext()){
			Faculty ftemp=(Faculty)(it.next());
			System.out.println(ftemp.getFid()+"\t"+ftemp.getName()+"\tf"+
				ftemp.getSalary());}
				
		Collections.sort (faculties, Collections.reverseOrder());
		Iterator it1=faculties.iterator();
		System.out.println("Faculties sorted by salary:");
		System.out.println("fid\t fname\tsalary");
		while(it1.hasNext()){
			Faculty ftemp=(Faculty)(it1.next());
			System.out.println(ftemp.getFid()+"\t"+ftemp.getName()+"\tf"+
				ftemp.getSalary());}
	}
}

import java.util.*;

public class CombyArrayList{
 
public static void main(String[] args){
 
 	ArrayList a1=new ArrayList();
 	a1.add("Jime");
 	a1.add("TomA");
 	a1.add("Jonh");
 	a1.add("Cormann");
 
 	ArrayList a2=new ArrayList();
 	a2.add("Lucy");
 	a2.add("Patrik");
 	a2.add("Sunny");
 	a2.add("Kity");
 
	System.out.println("The original Array list a1 is:");
 	System.out.println(a1);
 
 	System.out.println("The original Array list a2 is:");
 	System.out.println(a2);
 
 	int asize=a2.size();
 	for(int i=0;i<asize;i++) 
 	a1.add(a2.get(i));
 	
 	System.out.println("The Array list after combying a2 with a1 is:");
	System.out.println(a1);
 	 
	String sname="Sunny";
	int pos=a2.indexOf(sname);
	a2.remove(pos);

	System.out.println("The Array list after removing "+sname+" is:");
	System.out.println(a2);

 	a2.clear();
	System.out.println("After removing all the elements, a2 becomes:");
	System.out.println(a2);
	}
}
  
 


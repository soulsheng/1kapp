import java.util.*;

public class CombyLinkedList{
 
public static void main(String[] args){
 
 	LinkedList s1=new LinkedList();
 	s1.add("Jime");
 	s1.add("Tom");
 	s1.add("Jonh");
 	s1.add("Cormann");
 
 	LinkedList s2=new LinkedList();
 	s2.add("Lucy");
 	s2.add("Patrik");
 	s2.add("Sunny");
 	s2.add("Kity");
 
	System.out.println("The original linked list s1 is:");
 	System.out.println(s1);
 
 	System.out.println("The original linked list s2 is:");
 	System.out.println(s2);
 
 	ListIterator liter1=s1.listIterator();
 	Iterator liter2=s2.iterator();
 
 	while(liter2.hasNext())
 	{if(liter1.hasNext()) liter1.next();
  	liter1.add(liter2.next());}

	System.out.println("The linked list after combying s2 with s1 is:");
	System.out.println(s1);
 
	liter2=s2.iterator(); 
	String sname="Sunny";
	s2.remove(sname);

	System.out.println("The linked list after removing "+sname+" is:");
	System.out.println(s2);

 	s2.clear();
	System.out.println("After removing all the elements, s2 becomes:");
	System.out.println(s2);
	}
}
  
 


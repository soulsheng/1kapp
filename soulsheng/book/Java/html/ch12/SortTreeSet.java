import java.util.*;

public class SortTreeSet{
	public static void main(String[] args){
		TreeSet T=new TreeSet();
		T.add("John");
		T.add("Tom");
		T.add("Kite");
		Iterator iter=T.iterator();
		while(iter.hasNext())
		System.out.println(iter.next());
	}
}
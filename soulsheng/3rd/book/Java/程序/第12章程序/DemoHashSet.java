import java.util.*;
public class DemoHashSet {
	public static void main(String[] args) {
		HashSet h = new HashSet(1,1);
		h.add("One");
		h.add("Two");
		h.add("One"); // DUPLICATE
		h.add("Three");
		Iterator it = h.iterator();
		while (it.hasNext()) {
			System.out.println(it.next());
		}
	}
}


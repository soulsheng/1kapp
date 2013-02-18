import java.util.*;
public class DemoHashMap {
	public static void main(String[] args) {
		HashMap h = new HashMap();
		// The hash maps from company name to address.
		h.put("Adobe", "Mountain View, CA");
		h.put("IBM", "White Plains, NY");
		h.put("Sun", "Mountain View, CA");
		System.out.println("The original Hash Map:");
		System.out.println(h);
		String queryString = "Adobe";
		String resultString = (String)h.get(queryString);
		System.out.println("They are located in: " + resultString);
		h.remove(queryString);
        System.out.println("The modified Hash Map:");
        System.out.println(h);
	}
}

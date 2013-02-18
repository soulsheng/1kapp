public class ch4ex11{
	public static void main(String[]args){
		String s1="Computing includes five subject,that is CE CS SE IT IS";
		String s2;
		//the length should inlude space,punctuation etc
		System.out.println("the length of s1:"+s1.length());
		int pos=41;
		//position should include space,punctuation etc
		char ch;
		ch=s1.charAt(pos);
		System.out.println("The 41th character is "+ch);
		s2=s1.replace('C','c');
		System.out.println("the new s1 is "+s2);
		pos=s1.indexOf('C');
		System.out.println("the first character 'C' position is "+pos);
		pos=s1.indexOf('C',10);
		System.out.println("the second character 'C' position is "+pos);
		pos=s1.indexOf("IT");
		System.out.println("the word \"IT\" position is "+pos);
		s2=s1.substring(32);
		System.out.println("the substring started at 42th is "+s2);
		s2=s1.substring(32,36);
		System.out.println("the substring started at 32th and ended at 36th is "+s2);
		if(s1.startsWith("Computer"))
			System.out.println("found");
		else
			System.out.println("not found");
		if(s1.startsWith("Computing"))
			System.out.println("found");
		else
			System.out.println("not found");
		if(s1.endsWith("Computer"))
			System.out.println("found");
		else
			System.out.println("not found");
		s2=s1.toLowerCase();
		System.out.println("the lowercase s1 is "+s2);
		s2=s1.toUpperCase();
		System.out.println("the uppercase s1 is "+s2);	
	}
}		
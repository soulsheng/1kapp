public class ch6ex6{
	public static void main(String[]args){
		//创建包装类的对象
		Integer n=new Integer(42);
		Double d=new Double(12.21);
		Character c=new Character('w');
		//使用对象的公共方法
		System.out.println(n.intValue());
		System.out.println(d.doubleValue());
		System.out.println(c.charValue());
		//使用类的静态方法
		String s1=Integer.toString(45);
		String s2=Double.toString(12.34);
		System.out.println(s1);
		System.out.println(s2);
		//创建包装类的第二个对象
		Integer n1=new Integer(n.intValue()+1);
		Double d1=new Double(d.doubleValue());
		Character c1=new Character('W');
		//利用对象的公共方法比较两个对象值是否相等?
		if(n.equals(n1))
			System.out.println("n is equal n1");
		else
			System.out.println("n is not equal n1");
		if(d.equals(d1))
			System.out.println("d is equal d1");
		else
			System.out.println("d is not equal d1");
		if(c.equals(c1))
			System.out.println("c is equal c1");
		else
			System.out.println("c is not equal c1");
		//使用类的静态变量
		System.out.println("INTEGER MAXVALUE= "+Integer.MAX_VALUE);
		System.out.println("INTEGER MINVALUE= "+Integer.MIN_VALUE);
		System.out.println("DOUBLE MAXVALUE= "+Double.MAX_VALUE);
		System.out.println("DOUBLE MINVALUE= "+Double.MIN_VALUE);
		//Character类静态方法的使用
		char c2=c1.charValue();
		System.out.println("c2= "+c2);
		if(Character.isDigit(c2))
			System.out.println(c2+" is a digit");
		else
			System.out.println(c2+" is not a digit");
		if(Character.isLetter(c2))
			System.out.println(c2+" is a letter");
		else
			System.out.println(c2+" is not a letter");
		if(Character.isLowerCase(c2))
			System.out.println(c2+" is a lower case");
		else
			System.out.println(c2+" is not a lower case");
		if(Character.isUpperCase(c2))
			System.out.println(c2+" is a upper case");
		else
			System.out.println(c2+" is not a upper case");
		//数字既不是小写字母,也不是大写字母
		char c3='1';
		System.out.println("c3= "+c3);
		if(Character.isDigit(c3))
			System.out.println(c3+" is a digit");
		else
			System.out.println(c3+" is not a digit");
		if(Character.isLetter(c3))
			System.out.println(c3+" is a letter");
		else
			System.out.println(c3+" is not a letter");
		if(Character.isLowerCase(c3))
			System.out.println(c3+" is a lower case");
		else
			System.out.println(c3+" is not a lower case");
		if(Character.isUpperCase(c3))
			System.out.println(c3+" is a upper case");
		else
			System.out.println(c3+" is not a upper case");
		//演示两个类的静态方法,将字符串转换为int或double
		int tt=Integer.parseInt("1234");
		double dd=Double.parseDouble("1234.23");
		System.out.println(tt+1);
		System.out.println(dd+1);
	}
}
public class ch6ex6{
	public static void main(String[]args){
		//������װ��Ķ���
		Integer n=new Integer(42);
		Double d=new Double(12.21);
		Character c=new Character('w');
		//ʹ�ö���Ĺ�������
		System.out.println(n.intValue());
		System.out.println(d.doubleValue());
		System.out.println(c.charValue());
		//ʹ����ľ�̬����
		String s1=Integer.toString(45);
		String s2=Double.toString(12.34);
		System.out.println(s1);
		System.out.println(s2);
		//������װ��ĵڶ�������
		Integer n1=new Integer(n.intValue()+1);
		Double d1=new Double(d.doubleValue());
		Character c1=new Character('W');
		//���ö���Ĺ��������Ƚ���������ֵ�Ƿ����?
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
		//ʹ����ľ�̬����
		System.out.println("INTEGER MAXVALUE= "+Integer.MAX_VALUE);
		System.out.println("INTEGER MINVALUE= "+Integer.MIN_VALUE);
		System.out.println("DOUBLE MAXVALUE= "+Double.MAX_VALUE);
		System.out.println("DOUBLE MINVALUE= "+Double.MIN_VALUE);
		//Character�ྲ̬������ʹ��
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
		//���ּȲ���Сд��ĸ,Ҳ���Ǵ�д��ĸ
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
		//��ʾ������ľ�̬����,���ַ���ת��Ϊint��double
		int tt=Integer.parseInt("1234");
		double dd=Double.parseDouble("1234.23");
		System.out.println(tt+1);
		System.out.println(dd+1);
	}
}
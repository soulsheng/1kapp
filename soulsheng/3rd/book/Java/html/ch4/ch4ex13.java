public class ch4ex13{
	public static void main(String[]args){
		String studentName[]=new String[30];
		double math[]=new double[30];
		double javaProgramming[]=new double[30];
		String name;
		boolean find;
		int index=0;
		//��������,��ѧ�ɼ��Լ�Java������Ƴɼ�
		for(int j=0;j<30;j++){
			System.out.print("Enter student name: ");
			studentName[j]=Keyboard.readString();
			System.out.println();
			System.out.print("Enter Math: ");
			math[j]=Keyboard.readDouble();
			System.out.println();
			System.out.print("Enter Java programming: ");
			javaProgramming[j]=Keyboard.readDouble();
			System.out.println();
		}
		//������Ҫ��ѯѧ��������
		System.out.print("Enter a student name: ");
		name=Keyboard.readString();
		find=false;
		for(int j=0;j<30;j++){
			if(name.equals(studentName[j])){
				find=true;index=j;
				//�ҵ�,���˳�ѭ��
				break;
			}
		}
		if(!find)
			System.out.println("do not find student "+name);
		else{
			System.out.println(name);
			System.out.println("math "+math[index]);
			System.out.println("Java programming "+javaProgramming[index]);
		}
		
	}
}
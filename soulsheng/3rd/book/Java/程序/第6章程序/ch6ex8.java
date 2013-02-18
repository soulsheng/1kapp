class student{
	private String studentName;//����
	private int age;//����
	private String subject;//רҵ
	private String remove;//�༶
	//����һѧ������ѡ�γ�5��
	private String course[]=new String[5];//��ѡ�γ�
	private String courseCode[]=new String[5];//��ѡ�γ̴���
	private int courseNum;//��ѡ�γ���
	private int totalScores,topScores;//��ѡѧ�֡���ѡ��ѧ��
	public student(String sn,int a,String su,String re,int top){
		totalScores=0;courseNum=0;
		studentName=sn;age=a;
		subject=su;remove=re;topScores=top;
	}
	//��¼��ѡ�γ̡����룬������ѡ�γ�������ѡѧ����
	public void putCourse(String c,String cc,int sc){
		course[courseNum]=c;courseCode[courseNum]=cc;
		courseNum++;totalScores=totalScores+sc;
	}
	//�ж���ѡѧ���Ƿ񳬹���ѡ��ѧ��
	public boolean isGreateTotalScores(int sc){
		if((totalScores+sc)>topScores)
			return true;
		else
			return false;
	}
	//�ж���ѡ�γ��Ƿ񳬹�����ѡ�γ���
	public boolean isGreateCourseNum(){
		if((courseNum+1)>4)
			return true;
		else
			return false;
	}
	public void display(){
		System.out.println(studentName+"  "+age+"  "+subject+"  "+remove);
		for(int j=0;j<courseNum;j++){
			System.out.print("selected course: "+course[j]+"  course code:  "+courseCode[j]);
			System.out.println();
		}
		System.out.println("selected scores: "+totalScores);
	}
}
class course{
	private String courseName[]=new String[8];//�γ�����
	private int hoursPerWeek[]=new int[8];//��ѧʱ,Ҳ����ѧ��
	private String courseCode[]=new String[8];//�γ̴���
	private String teacherName[]=new String[8];//��ʦ����
	private String teacherTitle[]=new String[8];//ְ��
	private int totalNum[]=new int[8];//��ѡ������
	private int numSelected[]=new int[8];//��ѡ����
	public course(String c[],int h[],String cc[],String tname[],String tt[],int tn[]){
		for(int j=0;j<courseName.length;j++){
			courseName[j]=c[j];hoursPerWeek[j]=h[j];
			courseCode[j]=cc[j];teacherName[j]=tname[j];
			teacherTitle[j]=tt[j];totalNum[j]=tn[j];
			numSelected[j]=0;
		}
	}
	//���ָ���±�γ�����
	public String getCourseName(int index){
		return courseName[index];
	}
	//���ָ���±�γ̴���
	public String getCourseCode(int index){
		return courseCode[index];
	}
	//���ָ���±�γ�ѧʱ������ѧ����
	public int getScoreNum(int t){
		return hoursPerWeek[t];
	}
	//����ܵĿγ���Ŀ
		public int getCourseNum(){
		return courseName.length;
	}
	//��ѡ�γ�������1
	public void selectCourse(int index){
		numSelected[index]++;
	}
	//�����ѡ�γ�����
	public int getNumSelected(int index){
		return numSelected[index];
	}
	//��ÿ�ѡ������
	public int getTotalNum(int index){
		return totalNum[index];
	}
	public void display(){
		for(int j=0;j<courseCode.length;j++){
			System.out.print(courseName[j]+"  "+courseCode[j]+"  ");
			System.out.print(teacherName[j]+"  "+teacherTitle[j]+"  ");
			System.out.println(numSelected[j]+"  "+hoursPerWeek[j]);
		}
	}
}
public class ch6ex8{
	static int menu(){
		System.out.println("1. dispaly course status");
		System.out.println("2. dispaly student status");
		System.out.println("3. s1 selected course");
		System.out.println("4. s2 selected course");
		System.out.println("5. exit");
		int t;
		t=Keyboard.readInt();
		return t;
	}
	public static void main(String[]args){
		String cou[]={"Computing Essential","Java Programming","Operating System","Compiler","Data Structure","Graphics","Multimedia","Discrete Mathematics"};
		int week[]={3,4,4,4,4,3,3,4};
		String code[]={"D60578","D60342","D60123","D60458","D58321","D23564","D80321","D61234"};
		String name[]={"Richard","Grant","Stephen","Emma","Lisa","Linda","Shelia","Ronald"};
		String poit[]={"Professor","Assistant Professor","Lectuer","Lectuer","Professor","Professor","Lectuer","Lectuer"};
		int num[]={30,60,30,90,30,40,70,40};
		course c1=new course(cou,week,code,name,poit,num);
		student s1=new student("Zhang San",19,"Computing","200401",15);
		student s2=new student("Li si",18,"Business","200403",12);
		boolean con=true;;
		while(con){
			int opt;
			opt=menu();
			switch (opt){
				case 1:c1.display();break;
				case 2:s1.display();s2.display();break;
				case 3:
					if(s1.isGreateCourseNum()){
						System.out.println("You can not select new course because course number is full");
						break;
					}else{
						int t=0;
						System.out.println("please select course");
						boolean con1=true;
						for(int j=0;j<c1.getCourseNum();j++)
						System.out.print(j+". "+c1.getCourseName(j)+"    "+c1.getCourseCode(j)+"   ");
						System.out.println();
						while(con1){
							t=Keyboard.readInt();
							if(t>=0&&t<8)
								con1=false;
						}
						if(s1.isGreateTotalScores(c1.getScoreNum(t)))
							System.out.println("you can not select new course because scores is over");
						else if(c1.getNumSelected(t)>c1.getTotalNum(t)){
							System.out.println("you can not select because this class is full");
						}else{
							s1.putCourse(c1.getCourseName(t),c1.getCourseCode(t),c1.getScoreNum(t));
							c1.selectCourse(t);
						}
						break;
					}
				case 4:
					if(s2.isGreateCourseNum()){
						System.out.println("You can not select new course because course number is full");
						break;
					}else{
						int t=0;
						System.out.println("please select course");
						boolean con1=true;
						for(int j=0;j<c1.getCourseNum();j++)
						System.out.print(j+". "+c1.getCourseName(j)+"    "+c1.getCourseCode(j)+"   ");
						System.out.println();
						while(con1){
							t=Keyboard.readInt();
							if(t>=0&&t<8)
								con1=false;
						}
						if(s2.isGreateTotalScores(c1.getScoreNum(t)))
							System.out.println("you can not select new course because scores is over");
						else if(c1.getNumSelected(t)>c1.getTotalNum(t)){
							System.out.println("you can not select because this class is full");
						}else{
							s2.putCourse(c1.getCourseName(t),c1.getCourseCode(t),c1.getScoreNum(t));
							c1.selectCourse(t);
						}
						break;
					}
				case 5:con=false;break;
				default:System.out.println("Invalid input");
			}
		}
	}
}
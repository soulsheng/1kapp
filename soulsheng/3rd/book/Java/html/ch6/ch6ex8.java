class student{
	private String studentName;//姓名
	private int age;//年龄
	private String subject;//专业
	private String remove;//班级
	//假设一学期最多可选课程5门
	private String course[]=new String[5];//已选课程
	private String courseCode[]=new String[5];//已选课程代码
	private int courseNum;//已选课程数
	private int totalScores,topScores;//已选学分、可选总学分
	public student(String sn,int a,String su,String re,int top){
		totalScores=0;courseNum=0;
		studentName=sn;age=a;
		subject=su;remove=re;topScores=top;
	}
	//记录已选课程、代码，调整已选课程数、已选学分数
	public void putCourse(String c,String cc,int sc){
		course[courseNum]=c;courseCode[courseNum]=cc;
		courseNum++;totalScores=totalScores+sc;
	}
	//判断已选学分是否超过可选总学分
	public boolean isGreateTotalScores(int sc){
		if((totalScores+sc)>topScores)
			return true;
		else
			return false;
	}
	//判断已选课程是否超过最大可选课程数
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
	private String courseName[]=new String[8];//课程名称
	private int hoursPerWeek[]=new int[8];//周学时,也等于学分
	private String courseCode[]=new String[8];//课程代码
	private String teacherName[]=new String[8];//教师名字
	private String teacherTitle[]=new String[8];//职称
	private int totalNum[]=new int[8];//可选总人数
	private int numSelected[]=new int[8];//已选人数
	public course(String c[],int h[],String cc[],String tname[],String tt[],int tn[]){
		for(int j=0;j<courseName.length;j++){
			courseName[j]=c[j];hoursPerWeek[j]=h[j];
			courseCode[j]=cc[j];teacherName[j]=tname[j];
			teacherTitle[j]=tt[j];totalNum[j]=tn[j];
			numSelected[j]=0;
		}
	}
	//获得指定下标课程名称
	public String getCourseName(int index){
		return courseName[index];
	}
	//获得指定下标课程代码
	public String getCourseCode(int index){
		return courseCode[index];
	}
	//获得指定下标课程学时数，即学分数
	public int getScoreNum(int t){
		return hoursPerWeek[t];
	}
	//获得总的课程数目
		public int getCourseNum(){
		return courseName.length;
	}
	//已选课程人数加1
	public void selectCourse(int index){
		numSelected[index]++;
	}
	//获得已选课程人数
	public int getNumSelected(int index){
		return numSelected[index];
	}
	//获得可选总人数
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
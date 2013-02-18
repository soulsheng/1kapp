//简化Date类,保留本例中需要的功能
class Date{
	private int day;
	private int month;
	private int year;
	public Date(int d,int m,int y){
		day=d;month=m;year=y;
	}
	public int getMonth(){
		return month;
	}
	public void display(){
		System.out.println("Date:  "+getString());
	}
	private String getString(){
		String temp;
		return (day+"/"+month+"/"+year);
	}
}
public class ch6ex22{
	public static void main(String[]args){
		Date dates[]=new Date[30];
		for(int j=0;j<dates.length;j++){
			Date d1=getDate();
			dates[j]=d1;
		}
		for(int j=0;j<dates.length;j++){
			if(dates[j].getMonth()==2 || dates[j].getMonth()==7 || dates[j].getMonth()==10)
			dates[j].display();
		}
	}
	//通过随机数生成日期
	static Date getDate(){
		int y=(((int)(Math.random()*10000000))%9999)+1;
		int m=(((int)(Math.random()*10000000))%12)+1;
		int d=(((int)(Math.random()*10000000))%31)+1;
		Date date=new Date(d,m,y);
		return date;
	}
}
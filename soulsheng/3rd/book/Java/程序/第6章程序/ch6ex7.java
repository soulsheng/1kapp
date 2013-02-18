class Date{
	private int day;
	private int month;
	private int year;
	public Date(int d,int m,int y){
		day=d;month=m;year=y;
	}
	public int getDay(){
		return day;
	}
	public int getMonth(){
		return month;
	}
	public int getYear(){
		return year;
	}
	public void display(){
		System.out.println("Date:  "+getString());
	}
	public void successorDate(){
		int daysInMonth[]={31,28,31,30,31,30,31,31,30,31,30,31};
		//ÈòÄêÅĞ¶Ï
		if(year%4==0 && (year%100!=0 || year%400==00))
			daysInMonth[1]=29;
		if(day<daysInMonth[month])
			day++;
		else{
			day=1;
			if(month<12)
				month++;
			else{
				month=1;year++;
			}
		}
	}
	public boolean equals(Date d){
		if(day==d.getDay() && month==d.getMonth() && year==d.getYear())
			return true;
		else
			return false;
	}
	private String getString(){
		String temp;
		return (day+"/"+month+"/"+year);
	}
}
public class ch6ex7{
	public static void main(String[]args){
		Date d1=new Date(21,11,2004);
		Date d2=new Date(21,11,2004);
		if(d1.equals(d2))
			System.out.println("Date is equals");
		else
			System.out.println("Date is not equals");
		d1.successorDate();
		d1.display();
		d2.display();
		if(d1.getDay()==d2.getDay())
			System.out.println("Day is equals");
		else
			System.out.println("Day is not equals");
		if(d1.getMonth()==d2.getMonth())
			System.out.println("Month is equals");
		else
			System.out.println("Month is not equals");
			if(d1.getYear()==d2.getYear())
			System.out.println("Year is equals");
		else
			System.out.println("Year is not equals");
	}
}
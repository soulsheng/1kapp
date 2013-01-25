public class ch3ex8{
	public static void main(String[]args){
		int day,month,year;
		int ndays;
		System.out.print("Enter day number");
		day=Keyboard.readInt();
		System.out.println();
		System.out.print("Enter month number");
		month=Keyboard.readInt();
		System.out.println();
		System.out.print("Enter year number");
		year=Keyboard.readInt();
		System.out.println();
		if(month==4 || month==6 || month==9 || month==11)
			ndays=30;
		else if(month==2){
			if(year%4==0 &&(year%100!=0 || year%400==0))
				ndays=29;
			else	
				ndays=28;
		}
		else
			ndays=31;
		if(day<ndays)
			day=day+1;
		else{
			day=1;
			if(month<12)
				month=month+1;
			else{
				month=1;
				year=year+1;
			}
		}
		System.out.print("successor date is:");
		System.out.print(day);
		System.out.print("/");
		System.out.print(month);
		System.out.print("/");
		System.out.println(year);
	}
}	
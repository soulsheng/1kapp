class CounterException extends Exception{
	String message;
	public CounterException(String m){
		message=m;
	}
	public String getMessage(){
		return message;
	}
}
class Counter{
	private int count;
	public Counter(){
		count=0;
	}
	public void incCount(){
		count++;
	}
	public void decCount(){
		if(count>0)
	  		count--;
	}
	public int getCount(){
		return count;
	}
}
class ExhibitionMonitor extends Counter{
	private int capacity;
	public ExhibitionMonitor(int c) throws CounterException{
		super();
		if(c<=0)
	  		throw new CounterException("Counter must be positive");
		else
	  		capacity=c;
	}
	public int getCapacity(){
		return capacity;
	}
	public void enter() throws CounterException{
		if(getCount()<capacity)
	   		incCount();
		else
	   		throw new CounterException("Capacity exceeded");
	}
}
public class ch9ex5{
	public static void main(String[]args){
		try{
			ExhibitionMonitor cap=new ExhibitionMonitor(10);
			System.out.println("Exhibition Capacity :"+cap.getCapacity());
			for(int j=0;j<10;j++)
				cap.enter();
			cap.enter();
			System.out.println("Attendance :"+cap.getCount());
		}catch(CounterException e){
			System.out.println(e.getMessage());
		}
	}
}

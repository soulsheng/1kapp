//ExamProducerAndConsumer.java
public class ExamProducerAndConsumer{
	public static void main(String[] args){
		ProductMsgQueue products=new ProductMsgQueue();
		Producer producer=new Producer(products);
		Consumer consumer=new Consumer(products);
		producer.start();
		consumer.start();
	}
}

class ProductMsgQueue {
	static final int MAX_QUEUE_LENGTH=5;
	static int i=0;
	String[] msgArray;
	int queueLength;
	
	public ProductMsgQueue(){
		msgArray=new String[MAX_QUEUE_LENGTH];
		queueLength=0;}
	
	public synchronized void putMessage(){
		try{
			while(queueLength==MAX_QUEUE_LENGTH)
			wait();
		}catch(InterruptedException e){
			System.out.println("InterruptedException in putMessage: "+e); }
	        msgArray[queueLength++]="Message:"+i;
	        System.out.println("Message "+i+" is put into the queue by the producer!");
	        ++i;
	        notifyAll();
	}
	public synchronized String getMessage(){
		try{
			while(queueLength==0)
			wait();
		}catch(InterruptedException e){
			System.out.println("InterruptedException in getMessage: "+e); }
		String msg=msgArray[--queueLength];
		System.out.println(msg+" is gotten from the queue by the consumer!");
		notifyAll();
		return msg;
	}
}

class Producer extends Thread
{
	ProductMsgQueue productMsg;
	public  Producer(ProductMsgQueue productMsg){
		this.productMsg=productMsg;
	}
	public void run(){
		//int i=0;
		while (true)
		{productMsg.putMessage();
		 try{
			sleep(1000);
		 	}catch(InterruptedException e){
		 System.out.println("InterruptedException in revoking putMessage: "+e);}
		}
	}
}

class Consumer extends Thread {
	ProductMsgQueue productMsg;
	public Consumer(ProductMsgQueue productMsg){
		this.productMsg=productMsg;
	}
	public void run(){
		//int i=0;
		while (true)
		{productMsg.getMessage();
		 try{
			sleep(5000);
		 	}catch(InterruptedException e){
		 System.out.println("InterruptedException in revoking putMessage: "+e);}
		}
	}	
}
		
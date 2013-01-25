public class ExamActiveThreads{
	static void listCurrentThreads( ) {
    	ThreadGroup g=new ThreadGroup("Test");
        Thread t1=new Thread(g,"first");
        Thread t2=new Thread(g,"second");
        Thread t3=new Thread(g,"third");
        int numThreads;
        Thread listOfThreads[];
        g.list();
        numThreads=g.activeCount();
        t1.start();t2.start();t3.start();
        listOfThreads=new Thread[numThreads];
        g.enumerate(listOfThreads);
        for(int i=0;i<listOfThreads.length;i++)
        	System.out.println("Thread # "+i+"="+listOfThreads[i].getName());
	}
    public static void main(String[] args){
    	listCurrentThreads();
    }
}

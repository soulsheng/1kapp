class Badminton {
private String theTurn=null;

public synchronized boolean hit(String comp){
String curPlayer=Thread.currentThread().getName();
//System.out.println("current player:"+curPlayer);
if(theTurn!=null && theTurn.compareTo("Done!")==0)
return false;

if(comp!=null&&comp.compareTo("Done!")==0){
theTurn=comp;
notifyAll();
return false;
}
if(theTurn==null)
{theTurn=curPlayer;
return true;
}
if(curPlayer!=null && curPlayer.compareTo(theTurn)==0){
       System.out.println("Done!("+curPlayer+")");
        theTurn=comp;
        //System.out.println("current player "+curPlayer);
        notifyAll();
        }else
        {try {
                long l1=System.currentTimeMillis();
                wait(3000);
                if((System.currentTimeMillis()-l1)>3000){
                        System.out.println("******TIMEOUT! "+curPlayer
                        +" is waiting for "+theTurn+" to play.");
                }
                }catch(InterruptedException e){ }
        }
        return true;
}
}

class Player implements Runnable{
Badminton tennis;
String yourComp;

public Player(String comp,Badminton tennis){
        this.tennis=tennis;
        yourComp=comp;
}

public void run(){
        while(tennis.hit(yourComp));
}
}
public class ExamBadminton{
public static void main(String[] args){
        Badminton  tennis=new Badminton ();
        Thread wang=new Thread(new Player("Ma",tennis));
        Thread ma=new Thread(new Player("Wang",tennis));

        wang.setName("Wang");
        ma.setName("Ma");

        wang.start();
        ma.start();

        try{
        Thread.currentThread().sleep(5000);
        }catch(InterruptedException e){}
        tennis.hit("Done!");
        try{
        Thread.currentThread().sleep(200);
        }catch(InterruptedException e){}
}
}

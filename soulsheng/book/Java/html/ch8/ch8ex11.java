import java.io.*;
class Book{
	private String bookName;
	private String author;
	private String PRESS;
	int printNum;
	long wordNum;
	double price;
	public Book(){
		bookName="";author="";PRESS="";
		printNum=0;wordNum=0;price=0.0;
	}
	public Book(String b,String a,String p,int pn,long wn,double pr){
		bookName=b;author=a;PRESS=p;
		printNum=pn;wordNum=wn;price=pr;
	}
	public void put(DataOutputStream fout) throws Exception{
		fout.writeUTF(bookName);
		fout.writeUTF(author);
		fout.writeUTF(PRESS);
		fout.writeInt(printNum);
		fout.writeLong(wordNum);
		fout.writeDouble(price);
	}
	public void get(DataInputStream fin) throws Exception{
		bookName=fin.readUTF();
		author=fin.readUTF();
		PRESS=fin.readUTF();
		printNum=fin.readInt();
		wordNum=fin.readLong();
		price=fin.readDouble();
	}
	public void display(){
		System.out.println("Book Name  :"+bookName);
		System.out.println("Author Name  :"+author);
		System.out.println("PRESS  :"+PRESS);
		System.out.println("Print Number  :"+printNum);
		System.out.println("Word Number  :"+wordNum);
		System.out.println("Price  :"+price);
	}
}
public class ch8ex11{
	public static void main(String[]args){
		try{
			DataOutputStream fo=new DataOutputStream(new FileOutputStream("books.dat"));
			Book book=new Book("JAVA Programming","Richard","Higher Education Press",6000,500000,29.8);
			book.put(fo);
			book=new Book("Computing Essential","Brain","Higher Education Press",4000,300000,23.8);
			book.put(fo);
			book=new Book("Network and Communication","Grant","Higher Education Press",8000,750000,48.5);
			book.put(fo);
			fo.close();
			}catch(Exception e){
				e.printStackTrace();
			}
		try{
			DataInputStream fi=new DataInputStream(new FileInputStream("books.dat"));
			Book book;
			while(fi.available()>0){
				book=new Book();
				book.get(fi);
				book.display();
			}
			fi.close();
		}catch(Exception e){
			e.printStackTrace();
		}
	}
}
			
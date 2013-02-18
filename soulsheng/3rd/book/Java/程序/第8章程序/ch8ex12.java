import java.io.*;
import java.util.*;
class Product{
	private String productID;
	private String productName;
	private int quantity;
	private int threshold;
	public final static int productIDDim=16;
	public final static int productNameDim=30;
	public final static int productRecordSize=2*productIDDim+2*productNameDim+4*2;
	public Product(String pid,String pn,int q,int t)throws Exception{
		pid.trim();pn.trim();
		if(pid.length()<=productIDDim)
			productID=pid;
		else
			throw new Exception("Product ID is greater than MAX length");
		if(pn.length()<=productNameDim)
			productName=pn;
		else
			throw new Exception("Product name is greater than MAX length");
		quantity=q;threshold=t;
	}
	public Product(){
		productID="";productName="";
		quantity=0;threshold=0;
	}
	public boolean sell(int q){
		if(quantity-q>=0){
			quantity=quantity-q;
			return true;
		}else return false;
	}
	public void save(int q){
		quantity=quantity+q;
	}
	public void put(RandomAccessFile fOut)throws Exception{
		StringBuffer st=new StringBuffer(productID);
		st.setLength(productIDDim);
		String pid=st.toString();
		fOut.writeChars(pid);
		st=new StringBuffer(productName);
		st.setLength(productNameDim);
		String pn=st.toString();
		fOut.writeChars(pn);
		fOut.writeInt(quantity);
		fOut.writeInt(threshold);
	}
	public void get(RandomAccessFile fin)throws Exception{
        productID=getString(fin,productIDDim);
        productName=getString(fin,productNameDim);
        quantity=fin.readInt();
        threshold=fin.readInt();
	}
	private String getString(RandomAccessFile f,int length)throws Exception{
		String str="";
		char c;
		StringBuffer st=new StringBuffer(length);
		for(int j=0;j<length;j++){
			c=f.readChar();
			st.append(c);
		}
		int k=length;
		while(st.charAt(k-1)=='\0') k=k-1;
		st.setLength(k);
		str=st.toString();
		return str;
	}
	public boolean equalsProductID(String pid){
		return(pid.equals(productID));
	}
	public String getProductID(){return productID;}
	public String getProductName(){return productName;}
	public int getQuantity(){return quantity;}
	public int getThreshold(){return threshold;}
	public void display(){
		System.out.print("  Product ID   :"+productID);
		System.out.print("  Product Name :"+productName);
		System.out.print("  Quantity     :"+quantity);
		System.out.print("  Threshold    :"+threshold);
		System.out.println();
	}
}
class ProductFile{
	private String fileName;
	public ProductFile(String fn){fileName=fn;}
	public Product getProduct(String pid)throws Exception{
		Product p=new Product();
		RandomAccessFile fIn=new RandomAccessFile(fileName,"r");
		boolean found=false;
		int recCount=0;
		int numRecords=(int)fIn.length()/Product.productRecordSize;
		while(recCount<numRecords&&!found){
			p.get(fIn);
			if(p.equalsProductID(pid))
				found=true;
	   	 	else
	   	   		recCount=recCount+1;
		}
		fIn.close();
		if(!found)
			p=null;
		return p;	   
	}
	public void putProduct(Product product)throws Exception{
		Product p=getProduct(product.getProductID());
		if(p!=null)
			System.out.println("Product is in shop");
		else{
			RandomAccessFile fOut=new RandomAccessFile("ProductFile.dat","rw");
			fOut.seek(fOut.length());
			product.put(fOut);
			fOut.close();
		}
	}
	public void displayProducts()throws Exception{
		RandomAccessFile fIn=new RandomAccessFile("ProductFile.dat","r");
		Product p=new Product();
		int recCount=0;
		int numRecords=(int)fIn.length()/Product.productRecordSize;
		while(recCount<numRecords){
			p.get(fIn);
			p.display();
			recCount=recCount+1;
		}
		fIn.close();
	}
	public void queryProducts()throws Exception{
		RandomAccessFile fIn=new RandomAccessFile("ProductFile.dat","r");
		Product p=new Product();
		int recCount=0;
		int numRecords=(int)fIn.length()/Product.productRecordSize;
		while(recCount<numRecords){
			p.get(fIn);
			if(p.getQuantity()<=p.getThreshold())
				p.display();
			recCount=recCount+1;
		}
		fIn.close();
	}
	public boolean sellProduct(String pid,int quan)throws Exception{
		Product p=new Product();
		boolean found=false;
		RandomAccessFile fInOut=new RandomAccessFile("ProductFile.dat","rw");
		int recCount=0;
		int numRecords=(int)fInOut.length()/Product.productRecordSize;
		while(recCount<numRecords&&!found){
			p.get(fInOut);
			if(p.equalsProductID(pid))
				found=true;
			else
				recCount=recCount+1;
		}
		if(found){
			if(p.sell(quan)){
				fInOut.seek(recCount*Product.productRecordSize);
				p.put(fInOut);
			}else System.out.println("Product quantity is not enough");
		}
		fInOut.close();
		return found; 	
	}
	public boolean saveProduct(String pid,int quan)throws Exception{
		Product p=new Product();
		boolean found=false;
		RandomAccessFile fInOut=new RandomAccessFile("ProductFile.dat","rw");
		int recCount=0;
		int numRecords=(int)fInOut.length()/Product.productRecordSize;
		while(recCount<numRecords&&!found){
			p.get(fInOut);
			if(p.equalsProductID(pid))
				found=true;
			else
				recCount = recCount+1;
		}
		if(found){
			p.save(quan);
			fInOut.seek(recCount*Product.productRecordSize);
			p.put(fInOut);
		}
		fInOut.close();
		return found; 	
	}

}
class ProductsMenu{
	public static int show(Date d){
		int val;
		System.out.println("         The program start on "+d.toString());
		System.out.println("             *           1) Add New Product          *"); 
		System.out.println("             *           2) Display Product          *"); 
		System.out.println("             *           3) Search Product           *"); 
		System.out.println("             *           4) Sell Product             *");
		System.out.println("             *           5) Query About Quantity     *");
		System.out.println("             *           6) Add Product Quantity     *");
		System.out.println("             *           7) Exit                     *"); 
		System.out.println("             *****************************************"); 
		System.out.print("                           Enter choice: ");
		val=Keyboard.readInt();
		return val;
	}
}
public class ch8ex12{
	public static void main(String args[]){
		Date date=new Date();
		init();
		ProductFile products=new ProductFile("ProductFile.dat");
		ProductsMenu menu=new ProductsMenu();
		Product p;
		String pid;
		int quantity;
		boolean sold,save;
		int opt;
		boolean con=true;
		while(con){
			try{
				opt=menu.show(date);
				switch (opt){
					case 1:
						p=getProduct();
						products.putProduct(p);
						break;
					case 2:
						products.displayProducts();
						break;
					case 3:
						System.out.print("Enter product ID  : ");
						pid=Keyboard.readString();
						p=products.getProduct(pid);
						if(p!=null){
							System.out.println();
							p.display();
						}else{
					  		System.out.println(pid+" is not in shop");
						}
						break;
					case 4:
						System.out.print("Enter product ID    :");
						pid=Keyboard.readString();
						System.out.print("Enter the quantity  :");
						quantity=Keyboard.readInt();
						sold=products.sellProduct(pid,quantity);
						if(!sold)
					  		System.out.println(pid+" is not found");
					  	break;
					case 5:
						products.queryProducts();
						break;
					case 6:
						System.out.print("Enter product ID  : ");
						pid=Keyboard.readString();
						System.out.print("Enter the quantity  :");
						quantity=Keyboard.readInt();
						save=products.saveProduct(pid,quantity);
						if(!save)
					  		System.out.println(pid+" is not found");
						break;
					case 7:con=false;break;
					default:System.out.println("Invalid input");
				}
			}catch(Exception e){
				System.out.println(e.getMessage());
			}
		}
	}
	static void init(){
		File fexist=new File("ProductList.dat");
		if(!fexist.exists()){
			try{
				RandomAccessFile ftemp=new RandomAccessFile("ProductFile.dat","rw");
				ftemp.close();
			}catch(Exception e){System.out.println(e.getMessage());}
		}
	}
    static Product getProduct()throws Exception{
    	String pid,pn;
    	int q,t;
    	System.out.print("Product ID   :");
    	pid=Keyboard.readString();
     	System.out.print("Product Name :");
    	pn=Keyboard.readString();
    	System.out.print("Quantity     :");
    	q=Keyboard.readInt();
    	System.out.print("Threshold    :");
    	t=Keyboard.readInt();
 		Product prod=new Product(pid,pn,q,t);
  		return prod;
    }
}
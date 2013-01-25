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
        
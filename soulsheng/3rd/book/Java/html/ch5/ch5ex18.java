public class ch5ex18{
	static void InsertionSort(int a[]){
		for(int i=1;i<a.length;i++){
			int t=a[i];int j=i;
			while((j>0)&&(a[j-1]>t)){ 
				a[j]=a[j-1]; 
  				--j; 
  			} 
  			a[j]=t;
  		}
  	} 
	public static void main(String[]args){
		int intArray[]={1,13,3,6,10,55,98,2,87,12,34,75,33,47};
		InsertionSort(intArray);
		for(int j=0;j<intArray.length;j++)
			System.out.println(intArray[j]);
	}
}
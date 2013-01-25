//secondBean.java
import java.awt.*;
public class secondBean extends Canvas{
	//indexed属性
	int[] data_array={0,1,2,3,4,5};
	//构造方法
	public secondBean(){
		setBackground(Color.green);
		setForeground(Color.blue);
	}
	//设置整个数组
	public void setData_array(int[] x){
		data_array=x;
	}
	//设置单个元素值
	public void setData_array(int idx,int x){
		data_array[idx]=x;
	}
	//取得整个数组值
	public int[] getData_array(){
		return data_array;
	}
	//取得数组中的指定元素值
	public int getData_array(int idx){
		return data_array[idx];
	}
}
	
import javax.swing.*;
import javax.swing.event.*;
import java.awt.event.*;
import java.awt.*;
import java.sql.*;

//进货类用于处理进货操作
class Stocking extends JPanel implements MouseListener 
{	
//声明界面上的各个组件
	JLabel lWare_ID=null;
	JLabel lware_Name=null;
	JLabel l_amount=null;
	JLabel l_price=null;
	JLabel l_unit=null;
	JLabel l_date=null;
	JLabel l_null1=null;
	JLabel l_null2=null;
	JLabel l_null3=null;
	
	JTextField wareID=null;
	JTextField wareName=null;
	JTextField i_amount=null;
	JTextField i_price=null;
	JTextField i_unit=null;
	JTextField i_date=null;
	
	JButton b_query=null;
	JButton b_del=null;
	JButton b_update=null;
	JButton b_add=null;
	JButton b_next=null;
	ResultSet rst=null;
	
	Stocking(){
	//生成组件	
	lWare_ID=new JLabel("商品代码");
	lware_Name=new JLabel("商品名称");
	l_amount=new JLabel("进货数量");
	l_price=new JLabel("进货价格");
	l_unit=new JLabel("包装单位");
	l_date=new JLabel("进货日期");
	l_null1=new JLabel("  ");
	l_null2=new JLabel("  ");
	l_null3=new JLabel("  ");
	
	wareID=new JTextField(10);
	wareName=new JTextField(10);
	i_amount=new JTextField(6);
	i_price=new JTextField(6);
	i_unit=new JTextField(4);
	i_date=new JTextField(10);
		
    b_query=new	JButton("查询");
    b_add=new JButton("增加");
	b_del=new JButton("删除");
	b_update=new JButton("修改");
	b_next=new JButton("下一条");

	//布置组件	
	setLayout(new GridLayout(4,5));
	add(lWare_ID);
	add(wareID);
	add(lware_Name);
	add(wareName);
	add(b_next);
	
	add(l_amount);
	add(i_amount);
	add(l_price);
	add(i_price);
	add(l_null1);
	
	add(l_unit);
	add(i_unit);
	add(l_date);
	add(i_date);
	add(l_null2);
	
	
	add(b_add);
	add(b_query);	
	add(b_del);
	add(b_update);
   //用各个组件增加事件监听
		
	b_query.addMouseListener(this);
	b_del.addMouseListener(this);
	b_update.addMouseListener(this);
	b_add.addMouseListener(this);
	b_next.addMouseListener(this);
}
//实现鼠标事件监听
	public void mouseClicked(MouseEvent e) 
	{
		//如果单击的是查询按钮，执行如下操作
		if(e.getSource()==b_query)
		{
			try
			{
				rst=SqlDB.execQuery("select * from stocking_table where wares_ID='"+
					wareID.getText().trim()+"'");
			/*	if(rst.next())
					{wareName.setText(rst.getString(2));
		 			i_amount.setText(rst.getString(3));
		 			i_price.setText(rst.getString(4));
		 			i_unit.setText(rst.getString(5));
		 			i_date.setText(rst.getString(6));}*/
			
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
		
		}
		//向数据库增加记录
		else if(e.getSource()==b_add)
		{
			try {
				SqlDB.execUpdate("insert into stocking_table values('"+wareID.getText().trim()+
				"','"+wareName.getText()+"',"+Integer.parseInt(i_amount.getText().trim())+","+
				Float.parseFloat(i_price.getText().trim())+",'"+i_unit.getText().trim()+"','"+
				i_date.getText().trim()+"')");
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
	   }
	   //更新数据库中的记录
	   else if(e.getSource()==b_update){
	   	try{
	   		SqlDB.execUpdate("Update stocking_table Set i_amount='"+Integer.parseInt(i_amount.getText().trim())+
	   		                  "',i_price="+Float.parseFloat(i_price.getText().trim())+","+
	   		                  "units='"+i_unit.getText()+
	   		                  "',i_date='"+i_date.getText()+"' where wares_ID='"+
	   		                  wareID.getText().trim()+"'");
	   }catch(Exception ex)
	   {System.out.println(ex.getMessage());
		}
		}
	 //删除数据
	  else if(e.getSource()==b_del){
	  	SqlDB.execUpdate("delete stocking_table "+" where wares_id='"+wareID.getText().trim()+"'");
	 }
	  else if(e.getSource()==b_next){
	  	try{
	  		if(rst.next())
	  		{wareName.setText(rst.getString(2));
		 			i_amount.setText(rst.getString(3));
		 			i_price.setText(rst.getString(4));
		 			i_unit.setText(rst.getString(5));
		 			i_date.setText(rst.getString(6));
			
			}
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
			finally{
				SqlDB.closeDB();}
	  		
	}
	
}
  
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mousePressed(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
}
//库存类用于处理库存数据
class Storing extends JPanel implements MouseListener 
{	
//声明界面上的各个组件
	JLabel lWare_ID=null;
	JLabel lware_Name=null;
	JLabel l_amount=null;
	JLabel l_unit=null;
	JLabel l_date=null;
	JLabel l_null1=null;
	JLabel l_null2=null;
	JLabel l_null3=null;
	JLabel l_null4=null;
		
	JTextField wareID=null;
	JTextField wareName=null;
	JTextField s_amount=null;
	JTextField s_unit=null;
	JTextField s_date=null;
	
	JButton b_add=null;
	JButton b_query=null;
	JButton b_del=null;
	JButton b_update=null;
	JButton b_next=null;
	
	ResultSet rst=null;

	public Storing(){
//生成组件		
	lWare_ID=new JLabel("商品代码");
	lware_Name=new JLabel("商品名称");
	l_amount=new JLabel("库存数量");
	l_unit=new JLabel("包装单位");
	l_date=new JLabel("盘点日期");
	l_null1=new JLabel("");
	l_null2=new JLabel("");
	l_null3=new JLabel("");
	l_null4=new JLabel("");
	wareID=new JTextField(10);
	wareName=new JTextField(10);
	s_amount=new JTextField(6);
	s_unit=new JTextField(6);
	s_date=new JTextField(10);
		
    b_query=new	JButton("查询");
    b_del=new	JButton("删除");
	b_update=new JButton("修改");
	b_add=new JButton("增加");
	b_next=new JButton("下一条");
	
//布置组件
	setLayout(new GridLayout(4,4));
	add(lWare_ID);
	add(wareID);
	add(lware_Name);
	add(wareName);
	add(b_next);
	
	
	add(l_amount);
	add(s_amount);
	add(l_unit);
	add(s_unit);
	add(l_null1);
	
	add(l_date);
	add(s_date);
	add(l_null2);
	add(l_null3);
	add(l_null4);

	
	add(b_add);
	add(b_query);
	add(b_del);
	add(b_update);	
//增加事件监听
	b_query.addMouseListener(this);
	b_del.addMouseListener(this);
	b_update.addMouseListener(this);
	b_add.addMouseListener(this);
	b_next.addMouseListener(this);
}
//实现鼠标事件监听
public void mouseClicked(MouseEvent e) 
	{
		//查询功能
		if(e.getSource()==b_query)
		{
			try
			{
				rst=SqlDB.execQuery("select * from storage_table where wares_ID='"+
					wareID.getText().trim()+"'");
			/*	if(rst.next())
					{wareName.setText(rst.getString(2));
		 			i_amount.setText(rst.getString(3));
		 			i_price.setText(rst.getString(4));
		 			i_unit.setText(rst.getString(5));
		 			i_date.setText(rst.getString(6));}*/
			
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
		
		}
		//数据增加功能
		else if(e.getSource()==b_add)
		{
			try {
				SqlDB.execUpdate("insert into storage_table values('"+wareID.getText().trim()+
				"','"+wareName.getText()+"',"+Integer.parseInt(s_amount.getText().trim())+",'"+s_unit.getText().trim()+"','"+
				s_date.getText().trim()+"')");
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
	   }
	   //数据更新功能
	   else if(e.getSource()==b_update){
	   	try{	
		SqlDB.execUpdate("Update storage_table Set s_amount="+Integer.parseInt(s_amount.getText().trim())
	   		                  +",units='"+s_unit.getText()+ "',s_date='"+s_date.getText().trim()+"' where wares_ID='"+
	   		                  wareID.getText().trim()+"'");
	   	
	   }catch(Exception ex)
	   {System.out.println(ex.getMessage());
		}
		}
		//数据删除功能
	  else if(e.getSource()==b_del){
	  	SqlDB.execUpdate("delete storage_table "+" where wares_id='"+wareID.getText().trim()+"'");
	  }
	  else if(e.getSource()==b_next){
	  	try{
	  		if(rst.next())
	  		{wareName.setText(rst.getString(2));
		 			s_amount.setText(rst.getString(3));
		 		    s_unit.setText(rst.getString(4));
		 			s_date.setText(rst.getString(5));
			
			}
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
	  		
	}
	
}
  
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mousePressed(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
	
}
//销售类,用于处理销售管理
class Sales extends JPanel implements MouseListener 
{	
//声明界面上的组件
	JLabel lWare_ID=null;
	JLabel lware_Name=null;
	JLabel l_amount=null;
	JLabel l_price=null;
	JLabel l_unit=null;
	JLabel l_date=null;
	JLabel l_null1=null;
	JLabel l_null2=null;
	
	JTextField wareID=null;
	JTextField wareName=null;
	JTextField o_amount=null;
	JTextField o_price=null;
	JTextField o_unit=null;
	JTextField o_date=null;
	
	JButton b_query=null;
	JButton b_del=null;
	JButton b_update=null;
	JButton b_add=null;
	JButton b_next=null;
	ResultSet rst=null;

	Sales(){
//生成组件		
	lWare_ID=new JLabel("商品代码");
	lware_Name=new JLabel("商品名称");
	l_amount=new JLabel("销售数量");
	l_price=new JLabel("销售价格");
	l_unit=new JLabel("包装单位");
	l_date=new JLabel("盘点日期");
	l_null1=new JLabel("");
	l_null2=new JLabel("");
	
	wareID=new JTextField(10);
	wareName=new JTextField(10);
	o_amount=new JTextField(6);
	o_price=new JTextField(8);
	o_unit=new JTextField(8);
	o_date=new JTextField(10);
		
    b_query=new	JButton("查询");
    b_del=new	JButton("删除");
	b_update=new JButton("修改");
	b_add=new JButton("增加");
	b_next=new JButton("下一条");
//布置组件	
	
	setLayout(new GridLayout(4,5));
	add(lWare_ID);
	add(wareID);
	add(lware_Name);
	add(wareName);
	add(b_next);
	
	add(l_amount);
	add(o_amount);
	add(l_price);
	add(o_price);
	add(l_null1);
	
	add(l_unit);
	add(o_unit);
	add(l_date);
	add(o_date);
	add(l_null2);
	
	add(b_add);
	add(b_query);
	add(b_del);
	add(b_update);
//增加鼠标事件监听		
	b_query.addMouseListener(this);
	b_del.addMouseListener(this);
	b_update.addMouseListener(this);
	b_next.addMouseListener(this);
	b_add.addMouseListener(this);
}
//实现鼠标事件监听
	public void mouseClicked(MouseEvent e) 
	{
		//查询数据功能
		if(e.getSource()==b_query)
		{
			try
			{
				rst=SqlDB.execQuery("select * from sales_table where wares_ID='"+
					wareID.getText().trim()+"'");
						
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
		
		}
		//增加数据功能
		else if(e.getSource()==b_add)
		{
			try {
				SqlDB.execUpdate("insert into sales_table values('"+wareID.getText().trim()+
				"','"+wareName.getText()+"',"+Integer.parseInt(o_amount.getText().trim())+","+
				Float.parseFloat(o_price.getText().trim())+",'"+o_unit.getText().trim()+"','"+
				o_date.getText().trim()+"')");
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
	   }
	   //修改数据
	   else if(e.getSource()==b_update){
	   	try{
	   		SqlDB.execUpdate("Update sales_table Set o_amount="+Integer.parseInt(o_amount.getText().trim())+",o_price="+
	   		                 Float.parseFloat(o_price.getText())+",units='"+o_unit.getText()+ "',o_date='"+o_date.getText()
	   		                 +"' where wares_ID='"+wareID.getText().trim()+"'");
	   }catch(Exception ex)
	   {System.out.println(ex.getMessage());
		}
		}
		//删除数据
	  else if(e.getSource()==b_del){
	  	SqlDB.execUpdate("delete sales_table "+" where wares_id='"+wareID.getText().trim()+"'");
	  }
	  else if(e.getSource()==b_next){
	  	try{
	  		if(rst.next())
	  		{wareName.setText(rst.getString(2));
		 			o_amount.setText(rst.getString(3));
		 			o_price.setText(rst.getString(4));
		 		    o_unit.setText(rst.getString(5));
		 			o_date.setText(rst.getString(6));
			
			}
			}catch(Exception ex)
			{System.out.println(ex.getMessage());}
	  		
	}
	
}
  
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mousePressed(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
	
}
//主窗体	
class MainWin extends JFrame implements MouseListener{
//由一个菜单，三个四个子菜单组成，其中三个分别表示进货管理、库存管理和销售管理，
//第四个为系统退出系统
		JMenuBar bar=null;
		JMenu menu1,menu2,menu3,menu4;
		JMenuItem item1,item2,item3;
		JButton jb;
		Stocking stocking;
		Storing storing;
		Sales sales;
		MainWin(){
			setTitle("JDBC示例");
			bar=new JMenuBar();
			menu1=new JMenu("进货管理");
			menu2=new JMenu("库存管理");
			menu3=new JMenu("销售管理");
			menu4=new JMenu("退    出");
			bar.add(menu1);
			bar.add(menu2);
			bar.add(menu3);
			bar.add(menu4);
			this.setJMenuBar(bar);
			menu1.addMouseListener(this);
			menu2.addMouseListener(this);
			menu3.addMouseListener(this);
			menu4.addMouseListener(this);
			stocking=new Stocking();
			storing=new Storing();
			sales=new Sales();
	
			setVisible(true);
		}
		
		public void mouseClicked(MouseEvent e)
		{//进入进货管理模块
		
			if(e.getSource()==menu1)
			{
				remove(storing);
				remove(sales);
				getContentPane().add(stocking,"Center");
				this.repaint();
				validate();
	
			
			}
		//进入库存管理模块
			else if(e.getSource()==menu2)
			{ 
				remove(stocking);
				remove(sales);
		
			  	getContentPane().add(storing,"Center");
			  	this.repaint();
			  	validate();
			}
		//进入销售管理模块
			else if(e.getSource()==menu3)
			{
				remove(stocking);
				remove(storing); 
				getContentPane().add(sales,"Center");
				this.repaint();
				validate();
			}
			else if(e.getSource()==menu4){
				System.exit(0);
	}
	}
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mousePressed(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
}
//主应用程序，生成零售管理应用程序
public class Retail 
{ 
	public static void main(String[] args){
		MainWin mw=new MainWin();
		mw.setBounds(100,100,400,150);
		mw.show();
		mw.addWindowListener(new WindowAdapter(){
			public void windowsClosing(WindowEvent e){
				System.exit(0);
			}
		});
	}
}

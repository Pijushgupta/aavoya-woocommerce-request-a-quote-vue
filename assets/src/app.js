import react from 'react';
import reactDom from 'react-dom';
import Header from './Component/Header';
import Tabs from './Component/Tabs';

reactDom.render(
	<>
		<Header />
		<Tabs />
	</>,
	document.getElementById('awraq-root')
);

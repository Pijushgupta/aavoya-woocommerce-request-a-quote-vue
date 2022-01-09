import { useState } from 'react';

const Tabs = () => {

	const [toogleState, setToogleState] = useState(1);

	const toogleTab = (index) => {
		setToogleState(index);
	}

	return (
		<div className="container mx-auto px-4 py-4">
			<div className="flex flex-row">


				<div className="w-1/5 pr-2">
					<ul>
						<li className={(toogleState === 1) ? "aavoya-wraq-tab active" : "aavoya-wraq-tab"} onClick={() => toogleTab(1)}>
							<svg xmlns="http://www.w3.org/2000/svg" className="svg-class" viewBox="0 0 31.125 31.125">
								<path d="M.001 15.563c0 6.159 3.579 11.483 8.771 14.007L1.348 9.23a15.533 15.533 0 00-1.347 6.333zm26.068-.787c0-1.923-.69-3.255-1.283-4.291-.787-1.284-1.528-2.366-1.528-3.649 0-1.429 1.086-2.762 2.613-2.762.068 0 .134.008.203.011A15.513 15.513 0 0015.565 0C10.127 0 5.345 2.79 2.562 7.016c.365.011 3.153-.094 3.153-.094l5.981 18.2 3.406-10.213-2.776-8.073h5.146l5.859 18.158 1.555-5.188c.787-2.022 1.183-3.697 1.183-5.03zm-10.233 2.149l-4.67 13.566a15.59 15.59 0 009.565-.247 1.51 1.51 0 01-.113-.215l-4.782-13.104zm13.382-8.829c.068.496.105 1.027.105 1.602 0 1.578-.297 3.353-1.186 5.572l-4.752 13.743c4.627-2.698 7.737-7.709 7.737-13.45a15.448 15.448 0 00-1.904-7.467z" />
							</svg>
							Buttons
						</li>
						<li className={(toogleState === 2) ? "aavoya-wraq-tab active" : "aavoya-wraq-tab"} onClick={() => toogleTab(2)}>
							<svg xmlns="http://www.w3.org/2000/svg" className="svg-class" viewBox="0 0 456.029 456.029">
								<path d="M345.6 338.862c-29.184 0-53.248 23.552-53.248 53.248 0 29.184 23.552 53.248 53.248 53.248 29.184 0 53.248-23.552 53.248-53.248-.512-29.184-24.064-53.248-53.248-53.248zM439.296 84.91c-1.024 0-2.56-.512-4.096-.512H112.64l-5.12-34.304C104.448 27.566 84.992 10.67 61.952 10.67H20.48C9.216 10.67 0 19.886 0 31.15c0 11.264 9.216 20.48 20.48 20.48h41.472c2.56 0 4.608 2.048 5.12 4.608l31.744 216.064c4.096 27.136 27.648 47.616 55.296 47.616h212.992c26.624 0 49.664-18.944 55.296-45.056l33.28-166.4c2.048-10.752-5.12-21.504-16.384-23.552zM215.04 389.55c-1.024-28.16-24.576-50.688-52.736-50.688-29.696 1.536-52.224 26.112-51.2 55.296 1.024 28.16 24.064 50.688 52.224 50.688h1.024c29.184-1.536 52.224-26.112 50.688-55.296z" />
							</svg>
							Woocommerce
						</li>
					</ul>
				</div>
				<div className="w-4/5 aavoya-wraq-tab-body">
					<div className={toogleState === 1 ? " border w-full  bg-white" : " border w-full  bg-white hidden"}> Hello</div>
					<div className={toogleState === 2 ? " border w-full  bg-white" : " border w-full  bg-white hidden"}>Hi</div>
				</div>

			</div>
		</div>
	);
}

export default Tabs;